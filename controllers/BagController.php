<?php

class BagController
{
    /**
     * Bag page action
     * @return bool
     */
    public function actionIndex()
    {
        $categories = Category::getCategories();
        $bag = false;
        $bag = Bag::getProducts();
        $fmt = numfmt_create( 'uk_UA', NumberFormatter::CURRENCY );

        if ($bag) {
            $productsIds = array_keys($bag);
            $products = Product::getProductsByIds($productsIds);
            $totalPrice = Bag::calculateTotalPrice($products);

            if (!User::isGuest()) {
                $userId = User::checkLogged();
                $discounts = Discount::index($userId);
                foreach ($discounts as $discount) {
                    foreach ($products as $key => $product) {
                        if ($discount['product_id'] == $product['id']) {
                            $products[$key]['discount'] = $discount['discount'];
                        }
                    }
                }
            }
        }

        require_once ROOT . '/views/bag/index.php';
        return true;
    }

    /**
     * Adds product to bag using ajax
     * @return bool
     */
    public function actionAdd()
    {
        echo Bag::addProduct($_POST['id'], $_POST['volume']);
        return true;
    }

    public function actionReduce()
    {
        echo Bag::reduceProduct($_POST['id'], $_POST['volume']);
        return true;
    }

    public function actionChange()
    {
        echo Bag::changeProduct($_POST['id'], $_POST['quantity']);
        return true;
    }

    public function actionList()
    {
        echo json_encode(Bag::getProducts());
        return true;
    }

    public function actionData()
    {
        $products = Bag::getProducts();
        if ($products) {
            $details = Product::getProductsByIds(array_keys($products));
            $bag = [];
            $i = 0;
            foreach ($products as $key => $product) {
                foreach ($details as $item) {
                    if ($item['id'] == array_keys($products)[$i]) {
                        $bag[] = (object) [
                            'id' => intval($item['id']),
                            'quantity' => floatval($product),
                            'price' => floatval($item['price']),
                            'item_total' => floatval($item['price'] * $product),
                            'discount' => 0
                        ];
                    }
                }
                $i ++;
            }

            $totalDiscount = 0;

            if (!User::isGuest()) {
                $userId = User::checkLogged();
                $discounts = Discount::index($userId);
                foreach ($discounts as $discount) {
                    foreach ($bag as $key => $item) {
                        if ($discount['product_id'] == $item->id) {
                            $bag[$key]->discount = floatval($discount['discount']);
                            $totalDiscount += $discount['discount'] * $item->quantity;
                        }
                    }
                }
            }
            array_push($bag, $totalDiscount);
            echo json_encode($bag);
        }
        return true;
    }

    /**
     * Checkout page action
     * @return bool
     */
    public function actionCheckout()
    {
        $categories = Category::getCategories();
        $result = false;
        $fmt = numfmt_create( 'uk_UA', NumberFormatter::CURRENCY );
        $errors = false;

        if (isset($_POST['submit'])) {
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userAddress = $_POST['userAddress'];
            $userComment = $_POST['userComment'];

            if (!User::checkLength($userName, 2)) $errors[] = 1;
            if (!User::checkLength($userPhone, 10)) $errors[] = 2;

            if (!$errors) {
                $bag = Bag::getProducts();
                if (User::isGuest()) {
                    $userId = false;
                } else {
                    $userId = User::checkLogged();
                }

                $discountValue = 0;
                if (!User::isGuest()) {
                    $userId = User::checkLogged();
                    $discounts = Discount::index($userId);
                    foreach ($discounts as $discount) {
                        foreach ($bag as $key => $item) {
                            if ($discount['product_id'] == $key) {
                                $discountValue += ($discount['discount'] * $item);
                            }
                        }
                    }
                }

                $result = Order::save($userName, $userPhone, $userComment, $userAddress, $userId, $bag, $discountValue);

                if ($result) {
                    $productsIds = array_keys($bag);
                    $products = Product::getProductsByIds($productsIds);
                    $totalPrice = Bag::calculateTotalPrice($products);

                    $totalPrice = $totalPrice - $discountValue;
                    $totalNumber = Bag::countItems();

                    $adminEmail = 'vberkoz@gmail.com';

                    $subject = 'Замовлення: ' . $userName . ' ' . $userPhone;
                    $subject = '=?UTF-8?B?'.base64_encode($subject).'?=';

                    $message = '<html><body>';
                    $message .= '<p style="padding: 5px;">' . $userName . ' ' . $userPhone . ' ' . $userAddress . ' ' . $userComment . '</p>';
                    $message .= '<p style="padding: 5px;"><b>Товарів ' . $totalNumber . ' на суму ' . $totalPrice . ' грн.</b></p>';
                    $message .= '<table><tbody>';
                    foreach ($products as $product) {
                        $message .= '<tr><td style="padding: 5px;">' . $product['title'] . '</td><td style="padding: 5px;">' . $bag[$product['id']] * $product['volume'] . ' ' . $product['unit'] . '</td></tr>';
                    }
                    $message .= '</tbody></table>';
                    $message .= '</body></html>';

                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                    mail($adminEmail, $subject, $message, $headers);

                    Bag::clear();
                }
            } else {
                $bag = Bag::getProducts();
                $productsIds = array_keys($bag);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Bag::calculateTotalPrice($products);

                $discountValue = 0;
                if (!User::isGuest()) {
                    $userId = User::checkLogged();
                    $discounts = Discount::index($userId);
                    foreach ($discounts as $discount) {
                        foreach ($bag as $key => $item) {
                            if ($discount['product_id'] == $key) {
                                $discountValue += ($discount['discount'] * $item);
                            }
                        }
                    }
                }

                $totalPrice = $totalPrice - $discountValue;
                $totalNumber = Bag::countItems();
            }
        } else {
            $bag = Bag::getProducts();

            if (!$bag) {
                header("Location /");
            } else {
                $productsIds = array_keys($bag);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Bag::calculateTotalPrice($products);

                $discountValue = 0;
                if (!User::isGuest()) {
                    $userId = User::checkLogged();
                    $discounts = Discount::index($userId);
                    foreach ($discounts as $discount) {
                        foreach ($bag as $key => $item) {
                            if ($discount['product_id'] == $key) {
                                $discountValue += ($discount['discount'] * $item);
                            }
                        }
                    }
                }

                $totalPrice = $totalPrice - $discountValue;
                $totalNumber = Bag::countItems();

                $userName = false;
                $userPhone = false;
                $userComment = false;
                $userAddress = false;

                if (!User::isGuest()) {
                    $userId = User::checkLogged();
                    $user = User::getUser($userId);
                    $userName = $user['username'];
                    $userPhone = $user['phone'];
                    $userAddress = $user['address'];
                }
            }
        }

        require_once ROOT . '/views/bag/checkout.php';
        return true;
    }

    /**
     * Remove product action
     * @param $id
     */
    public function actionRemove($id)
    {
        Bag::removeProduct($id);
        header("Location: /bag/");
    }
}
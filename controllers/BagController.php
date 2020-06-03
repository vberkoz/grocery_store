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
        }

        require_once ROOT . '/views/bag/index.php';
        return true;
    }

    /**
     * Adds product to bag
     * @param $id
     */
    public function actionAdd($id)
    {
        Bag::addProduct($id);
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    }

    /**
     * Adds product to bag using ajax
     * @param $id
     * @return bool
     */
    public function actionAddajax($id)
    {
        echo Bag::addProduct($id);
        return true;
    }

    public function actionRemoveajax($id)
    {
        echo Bag::reduceProduct($id);
        return true;
    }

    public function actionChangeajax($id)
    {
        echo Bag::changeProduct($id);
        return true;
    }

    public function actionIndexajax()
    {
        echo json_encode(Bag::getProducts());
        return true;
    }

    public function actionData()
    {
        if (!User::isGuest()) {
            $userId = User::checkLogged();
            $user = User::getUser($userId);
            $discount = $user['discount'];
        } else {
            $discount = 0;
        }

        $products = Bag::getProducts();
        $details = Product::getProductsByIds(array_keys($products));
        $bag = [];
        $i = 0;
        foreach ($products as $key => $product) {
            foreach ($details as $item) {
                if ($item['id'] == array_keys($products)[$i]) {
                    $bag[] = (object) [
                        'id' => intval($item['id']),
                        'quantity' => intval($product),
                        'price' => floatval($item['price']),
                        'item_total' => floatval($item['price'] * $product)
                    ];
                }
            }
            $i ++;
        }
        array_push($bag, $discount);
        echo json_encode($bag);
        return true;
    }

    /**
     * Checkout page action
     * @return bool
     */
    public function actionCheckout()
    {
        if (!User::isGuest()) {
            $userId = User::checkLogged();
            $user = User::getUser($userId);
            $discount = $user['discount'];
        } else {
            $discount = 0;
        }

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

                $result = Order::save($userName, $userPhone, $userComment, $userAddress, $userId, $bag);

                if ($result) {
                    $productsIds = array_keys($bag);
                    $products = Product::getProductsByIds($productsIds);
                    $totalPrice = Bag::calculateTotalPrice($products);
                    $totalPrice = $totalPrice - ($totalPrice * ($discount * 0.01));
                    $totalNumber = Bag::countItems();

                    $adminEmail = 'vberkoz@gmail.com';

                    $subject = 'Замовлення: ' . $userName . ' ' . $userPhone;
                    $subject = '=?UTF-8?B?'.base64_encode($subject).'?=';

                    $message = '<html><body>';
                    $message .= '<p style="padding: 5px;">' . $userName . ' ' . $userPhone . ' ' . $userAddress . ' ' . $userComment . '</p>';
                    $message .= '<p style="padding: 5px;"><b>Товарів ' . $totalNumber . ' на суму ' . $totalPrice . 'грн.</b></p>';
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
                $totalPrice = $totalPrice - ($totalPrice * ($discount * 0.01));
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
                $totalPrice = $totalPrice - ($totalPrice * ($discount * 0.01));
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
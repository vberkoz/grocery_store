<?php

class BagController
{
    /**
     * Bag page action
     * @return bool
     */
    public function actionIndex() {
        $bag = false;
        $bag = Bag::getProducts();
        $fmt = numfmt_create( 'en_EN', NumberFormatter::CURRENCY );

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
    public function actionAdd($id) {
        Bag::addProduct($id);
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    }

    /**
     * Adds product to bag using ajax
     * @param $id
     * @return bool
     */
    public function actionAddajax($id) {
        echo Bag::addProduct($id);
        return true;
    }

    /**
     * Checkout page action
     * @return bool
     */
    public function actionCheckout() {
        $result = false;
        $fmt = numfmt_create( 'en_EN', NumberFormatter::CURRENCY );
        $errors = false;

        if (isset($_POST['submit'])) {
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
//            echo '<pre>';print_r($userName);die;

            if (!User::checkLength($userName, 2)) $errors[] = 1;
            if (!User::checkLength($userPhone, 10)) $errors[] = 2;

            if (!$errors) {
                $bag = Bag::getProducts();
                if (User::isGuest()) {
                    $userId = false;
                } else {
                    $userId = User::checkLogged();
                }

                $result = Order::save($userName, $userPhone, $userComment, $userId, $bag);

                if ($result) {
                    $adminEmail = 'vberkoz@gmail.com';
                    $subject = 'Shop PHP Zin New Order';
                    $message = 'http://localhost:4000/admin/orders';
                    mail($adminEmail, $subject, $message);

                    Bag::clear();
                }
            } else {
                $bag = Bag::getProducts();
                $productsIds = array_keys($bag);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Bag::calculateTotalPrice($products);
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
                $totalNumber = Bag::countItems();

                $userName = false;
                $userPhone = false;
                $userComment = false;

                if (!User::isGuest()) {
                    $userId = User::checkLogged();
                    $user = User::getUser($userId);
                    $userName = $user['username'];
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
    public function actionRemove($id) {
        Bag::removeProduct($id);
        header("Location: /bag/");
    }
}
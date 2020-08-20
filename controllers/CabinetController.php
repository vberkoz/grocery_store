<?php

class CabinetController
{
    /**
     * History page
     * @return bool
     */
    public function actionHistory()
    {
        require_once ROOT . '/views/cabinet/history.php';
        return true;
    }

    public function actionOrders()
    {
        echo json_encode(
            Order::history(
                User:: checkLogged()
            )
        );
        return true;
    }

    public function actionOrderUpdate()
    {
        if (floatval($_POST['quantity'])) {
            echo json_encode(OrderedProduct::update($_POST['order_id'], $_POST['product_id'], $_POST['quantity']));
        } else {
            echo json_encode(OrderedProduct::remove($_POST['order_id'], $_POST['product_id']));
        }
        return true;
    }

    public function actionOrderRemove()
    {
        Order::delete($_POST['order_id']);
        return true;
    }

    public function actionOrderCopy()
    {
        Order::copy(intval($_POST['order_id']));
        return true;
    }

    public function actionOrderProductAdd()
    {
        echo json_encode($_POST);
        return true;
    }

    /**
     * Liked products page
     * @return bool
     */
    public function actionLiked()
    {
        $categories = Category::getCategories();
        $userId = User::checkLogged();
        $products = Like::userLikes($userId);
        $fmt = numfmt_create( 'uk_UA', NumberFormatter::CURRENCY );
        require_once ROOT . '/views/cabinet/liked.php';
        return true;
    }

    /**
     * Settings page
     * @return bool
     */
    public function actionEdit() {
        $categories = Category::getCategories();
        $userId = User::checkLogged();
        $user = User::getUser($userId);
        $errors = false;

        $user_email = $user['email'];
        $user_name = $user['username'];
        $user_phone = $user['phone'];
        $user_address = $user['address'];
        $hash = $user['secret'];

        if (array_key_exists('secret2', $user)) {
            $secret2 = $user['secret2'];
        } else {
            $secret2 = $user['secret'];
        }

        $result = false;

        if (isset($_POST['change_info'])) {
            $user_name = $_POST['user_name'];
            $user_phone = $_POST['user_phone'];
            $user_address = $_POST['user_address'];

            if (!User::checkLength($user_name, 2)) $errors[] = 1;
            if (!User::checkLength($user_phone, 10)) $errors[] = 6;

            if (!$errors) {
                $result = User::update($userId, $user_name, $user_phone, $user_address);
            }
        }

        if (isset($_POST['change_pass'])) {
            $old = $_POST['old'];
            $secret = $_POST['secret'];
            $secret2 = $_POST['secret2'];

            if (!password_verify($old, $hash)) $errors[] = 2;
            if (!User::checkLength($secret, 6)) $errors[] = 3;
            if (!User::checkLength($secret2, 6)) $errors[] = 4;
            if (!User::checkSecretMatch($secret, $secret2)) $errors[] = 5;

            if (!$errors) {
                $result = User::update($userId, $user_name, $user_phone, $user_address, password_hash($secret, PASSWORD_DEFAULT));
            }
        }

        require_once ROOT . '/views/cabinet/edit.php';
        return true;
    }
}
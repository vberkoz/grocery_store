<?php

class CabinetController
{
    /**
     * User cabinet main page
     * @return bool
     */
    public function actionIndex() {
        $userId = User::checkLogged();
        $user = User::getUser($userId);

        require_once ROOT . '/views/cabinet/index.php';
        return true;
    }

    /**
     * Cabinet history page
     * @return bool
     */
    public static function actionHistory() {
        $userId = User::checkLogged();
        $orders = Order::getUserOrders($userId);
        $fmt = numfmt_create( 'en_EN', NumberFormatter::CURRENCY );

        require_once ROOT . '/views/cabinet/history.php';
        return true;
    }

    /**
     * Cabinet edit user page
     * @return bool
     */
    public function actionEdit() {
        $userId = User::checkLogged();
        $user = User::getUser($userId);
        $errors = false;

        $user_email = $user['email'];
        $user_name = $user['username'];
        $secret1 = $user['secret'];

        if (array_key_exists('secret2', $user)) {
            $secret2 = $user['secret2'];
        } else {
            $secret2 = $user['secret'];
        }

        $result = false;

        if (isset($_POST['submit'])) {
            $user_name = $_POST['user_name'];
            $old = $_POST['old'];
            $secret = $_POST['secret'];
            $secret2 = $_POST['secret2'];

            if (!User::checkLength($user_name, 2)) $errors[] = 1;
            if (!User::checkSecretMatch($secret1, $old)) $errors[] = 2;
            if (!User::checkLength($secret, 6)) $errors[] = 3;
            if (!User::checkLength($secret2, 6)) $errors[] = 4;
            if (!User::checkSecretMatch($secret, $secret2)) $errors[] = 5;

            if (!$errors) {
                $result = User::edit($userId, $user_name, $secret);
            }
        }

        require_once ROOT . '/views/cabinet/edit.php';
        return true;
    }

    public function actionLiked()
    {
        $userId = User::checkLogged();
        $user = User::getUser($userId);

        require_once ROOT . '/views/cabinet/liked.php';
        return true;
    }
}
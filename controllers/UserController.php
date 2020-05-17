<?php

class UserController
{
    /**
     * Loads user sign up page
     * @return bool
     */
    public static function actionSignup() {
        $name = '';
        $email = '';
        $password = '';
        $errors = false;

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $repeat = $_POST['repeat'];

            if (!User::checkLength($name, 2)) $errors[] = 1;
            if (!User::checkEmail($email)) {
                $errors[] = 2;
            } else {
                if (User::checkEmailExists($email)) $errors[] = 3;
            }
            if (!User::checkLength($password, 6)) $errors[] = 4;
            if (!User::checkSecretMatch($password, $repeat)) $errors[] = 5;

            if ($errors == false) $result = User::register($name, $email, $password);
        }

        require_once ROOT . '/views/user/signup.php';
        return true;
    }

    /**
     * Loads user sign in page
     * @return bool
     */
    public static function actionSignin() {
        $email = '';
        $password = '';
        $errors = false;

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (!User::checkEmail($email)) $errors[] = 1;
//            if (!User::checkLength($password, 6)) $errors[] = 2;

            $userId = User::checkUserData($email, $password);

            if (!$errors) {
                if ($userId == false) {
                    $errors[] = 3;
                } else {
                    User::auth($userId);
                    $user = User::getUser($userId);

                    if ($user['role'] == 'admin') {
                        header("Location: /admin/");
                    } else {
                        header("Location: /cabinet/history");
                    }
                }
            }
        }

        require_once ROOT . '/views/user/signin.php';
        return true;
    }

    /**
     * Signs out current user
     */
    public function actionSignout() {
        session_start();
        unset($_SESSION['user']);
        header("Location: /");
    }
}
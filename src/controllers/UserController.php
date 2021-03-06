<?php

class UserController extends PublicBase
{
    /**
     * Loads user sign up page
     * @return bool
     */
    public function actionSignup()
    {
        $categories = Category::getCategories();
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

            if ($errors == false) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $result = User::register($name, $email, $password);
                User::auth($result);
            }
        }

        require_once ROOT . '/views/user/signup.php';
        return true;
    }

    /**
     * Loads user sign in page
     * @return bool
     */
    public function actionSignin()
    {
        $categories = Category::getCategories();
        $email = '';
        $password = '';
        $errors = false;

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (!User::checkEmail($email)) $errors[] = 1;

            $userId = User::checkUserData($email, $password);

            if (!$errors) {
                if ($userId == false) {
                    $errors[] = 3;
                } else {
                    User::auth($userId);
                    $user = User::getUser($userId);

                    if ($user['role'] == 'admin') {
                        header("Location: /admin/order");
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
    public function actionSignout()
    {
        unset($_SESSION['user']);
        header("Location: /");
    }

    /**
     * Send instructions to change password
     */
    public function actionForgot()
    {
        $email = $_POST['email'];
        if (User::checkEmailExists($email)) {
            $link = self::makeHash();
            User::setChangeSecretLink($email, $link);

            $subject = 'Vitamin+ невдала спроба доступу';
            $subject = '=?UTF-8?B?'.base64_encode($subject).'?=';

            $restoreLink = 'http://' . $_SERVER["HTTP_HOST"] . '/change-secret/' . $link;

            $message = '<html><body>';
            $message .= '<p style="padding: 5px;">Для відновлення доступу до вашого облікового запису перейдіть за посиланням: </p>';
            $message .= '<p style="padding: 5px;"><a href="' . $restoreLink . '">' . $restoreLink . '</a></p>';
            $message .= '</body></html>';

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            mail($email, $subject, $message, $headers);
        }
        return true;
    }

    public function actionChangeSecret($link)
    {
        if (!User::checkLinkExists($link)) header("Location: /");
        $categories = Category::getCategories();
        $errors = false;

        if (isset($_POST['submit'])) {
            $password = $_POST['password'];
            $repeat = $_POST['repeat'];
            if (!User::checkLength($password, 6)) $errors[] = 1;
            if (!User::checkSecretMatch($password, $repeat)) $errors[] = 2;
            if (!$errors) {
                User::changeSecret($link, password_hash($password, PASSWORD_DEFAULT));
                User::deleteChangeSecretLink($link);
                $result = true;
            }
        }

        require_once ROOT . '/views/user/change.php';
        return true;
    }
}
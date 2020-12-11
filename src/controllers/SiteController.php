<?php

class SiteController extends PublicBase
{
    /**
     * Loads main page
     */
    public function actionIndex()
    {
        $pageTitle = 'Головна';
        $fmt = numfmt_create( 'uk_UA', NumberFormatter::CURRENCY );
        if (User::isGuest()) {
            $products = Product::getProducts();
            $userId = 0;
        } else {
            $userId = User::checkLogged();
            $products = Product::getProducts('', $userId);
        }

        require_once ROOT . '/views/site/index.php';
        return true;
    }

    /**
     * Contact page action
     * @return bool
     */
    public function actionContact()
    {
        $categories = Category::getCategories();
        $userEmail = '';
        $userText = '';
        $result = false;
        $errors = false;

        if (isset($_POST['submit'])) {
            $userEmail = $_POST['email'];
            $userText = $_POST['message'];

            if (!User::checkEmail($userEmail)) $errors[] = 1;

            if ($errors == false) {
                $adminEmail = 'vberkoz@gmail.com';
                $subject = 'Shop PHP Zin Message';
                $message = "$userEmail $userText";
                $result = mail($adminEmail, $subject, $message);
                $result = true;
            }
        }

        require_once ROOT . '/views/site/contact.php';
        return true;
    }
}
<?php

class SiteController
{
    /**
     * Loads main page
     * @return bool
     */
    public function actionIndex()
    {
//        $categories = Category::getCategories();
//        $products = Product::getProducts(4);
//        $featuredItems = Product::getFeaturedProducts();
//
//        require_once ROOT . '/views/site/index.php';
        header("Location: /category/1");
        return true;
    }

    /**
     * Contact page action
     * @return bool
     */
    public function actionContact()
    {
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
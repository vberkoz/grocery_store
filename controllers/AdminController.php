<?php

class AdminController extends AdminBase
{
    /**
     * Administration area main page
     * @return bool
     */
    public function actionIndex()
    {
        self::checkAdmin();

        $fmt = numfmt_create( 'uk_UA', NumberFormatter::CURRENCY );
        $products = Order::getUserProducts();
        $total = 0;
        foreach ($products as $product) {
            $total += $product['price'];
        }

        $requests = Request::index();

        require_once ROOT . '/views/admin/index.php';
        return true;
    }
}
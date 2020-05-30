<?php

class AdminController extends AdminBase
{
    /**
     * Administration area main page
     * @return bool
     */
    public function actionIndex() {
        self::checkAdmin();
//        header("Location: /admin/product");

        $fmt = numfmt_create( 'uk_UA', NumberFormatter::CURRENCY );
        $products = Order::getUserProducts();
        $total = 0;
        foreach ($products as $product) {
            $total += $product['price'];
        }

//        echo '<pre>';print_r($products);die;

        require_once ROOT . '/views/admin/index.php';
        return true;
    }
}
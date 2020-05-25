<?php

class ProductController
{
    /**
     * Loads products list page
     * @param int $categoryId
     * @param int $page
     * @return bool
     */
    public function actionIndex($categoryId = 1, $page = 1) {
        $categories = Category::getCategories();
        $products = Product::getProducts(24, $page, $categoryId);
        $total = Product::getProductsNumber($categoryId);
        $pagination = new Pagination($total, $page, 24, 'page-');
        $fmt = numfmt_create( 'uk_UA', NumberFormatter::CURRENCY );

        require_once ROOT . '/views/product/index.php';
        return true;
    }

    /**
     * Loads single product page
     * @param $productId
     * @return bool
     */
    public function actionShow($productId, $categoryId) {
        $categories = Category::getCategories();
        $product = Product::getProduct($productId);
        $fmt = numfmt_create( 'uk_UA', NumberFormatter::CURRENCY );

        require_once ROOT . '/views/product/show.php';
        return true;
    }
}
<?php

class ProductController
{
    /**
     * Loads products list page
     * @param int $categoryId
     * @param int $page
     * @return bool
     */
    public function actionIndex($categoryId = 1, $page = 1)
    {
        $categories = Category::getCategories();
        if (User::isGuest()) {
            $products = Product::getProducts(24, $page, $categoryId);
            $userId = 0;
        } else {
            $userId = User::checkLogged();
            $products = Product::getProducts(24, $page, $categoryId, $userId);
        }
        
        $total = Product::getProductsNumber($categoryId);
        $pagination = new Pagination($total, $page, 24, 'page-');
        $fmt = numfmt_create( 'uk_UA', NumberFormatter::CURRENCY );

        require_once ROOT . '/views/product/index.php';
        return true;
    }

    public function actionSearch()
    {
        echo json_encode(Product::find($_POST['search_term'], $_POST['user_id']));
        return true;
    }
}
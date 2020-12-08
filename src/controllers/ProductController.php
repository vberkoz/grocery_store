<?php

class ProductController
{
    /**
     * Loads products list page by category slug
     * @param string $category
     * @return bool
     */
    public function actionIndex(string $category): bool
    {
        $categories = Category::getCategories();
        if (User::isGuest()) {
            $products = Product::getProducts($category);
            $userId = 0;
        } else {
            $userId = User::checkLogged();
            $products = Product::getProducts($category, $userId);
        }

//        $total = Product::getProductsNumber($categoryId);
//        $pagination = new Pagination($total, $page, 24, 'page-');
        $fmt = numfmt_create( 'uk_UA', NumberFormatter::CURRENCY );

        require_once ROOT . '/views/product/index.php';
        return true;
    }

    /**
     * Loads product details page
     * @param string $slug
     * @return bool
     */
    public function actionShow(string $slug): bool
    {
        $product = Product::single($slug);
        $product['characteristics'] = json_decode($product['characteristics'], true);
        $pageTitle = $product['title'];
        $reviews = Review::listByProductId($product['id']);
        $fmt = numfmt_create( 'uk_UA', NumberFormatter::CURRENCY );

        if (User::isGuest()) {
            $products = Product::getProducts($product['category_slug']);
            $userId = 0;
        } else {
            $userId = User::checkLogged();
            $products = Product::getProducts($product['category_slug'], $userId);
        }

        require_once ROOT . '/views/product/details.php';
        return true;
    }

    public function actionSearch(): bool
    {
        echo json_encode(Product::find($_POST['search_term'], $_POST['user_id']));
        return true;
    }
}

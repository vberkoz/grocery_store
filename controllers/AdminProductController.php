<?php

class AdminProductController extends AdminBase
{
    /**
     * Products list
     * @return bool
     */
    public function actionIndex($categoryId)
    {
        self::checkAdmin();
        $categories = Category::getCategories();
        $products = Product::getProductsForAdmin($categoryId);
        $fmt = numfmt_create( 'uk_UA', NumberFormatter::CURRENCY );
        require_once ROOT . '/views/admin_product/index.php';
        return true;
    }

    /**
     * Remove product
     * @param $id
     */
    public function actionDelete($id)
    {
        self::checkAdmin();
        Product::deleteProduct($id);
        header("Location: /admin/product");
    }

    /**
     * Create product
     */
    public function actionCreate()
    {
        self::checkAdmin();

        $product['title'] = 'Новий Товар';
        $product['category_id'] = 1;
        $product['product_id'] = self::generateProductId();
        $product['price'] = 1;
        $product['availability'] = 1;
        $product['visibility'] = 0;
        $product['image'] = 'no-image.jpg';
        $product['volume'] = 1;
        $product['volume_min'] = 0.1;
        $product['unit'] = 'кг';

        $id = Product::createProduct($product);
        header("Location: /admin/product");
    }

    /**
     * Update product
     * @param $id
     * @return bool
     */
    public function actionUpdate($id)
    {
        self::checkAdmin();
        $categories = Category::getCategories();
        $product = Product::getProduct($id);
        $image = '/template/images/' . $product['image'];
        $errors = false;

        if (isset($_POST['submit'])) {
            $product['title'] = $_POST['title'];
            $product['category_id'] = $_POST['category_id'];
            $product['price'] = $_POST['price'];
            $product['volume'] = $_POST['volume'];
            $product['volume_min'] = $_POST['volume_min'];
            $product['unit'] = $_POST['unit'];
            $product['availability'] = $_POST['availability'];
            $product['visibility'] = $_POST['visibility'];

            if ($_FILES['image']['name']) {
                $product['image'] = $_FILES['image']['name'];
            }

            if (!isset($product['title']) || empty($product['title'])) {
                $errors[] = 1;
            }

            if (!$errors) {
                if (Product::updateProduct($id, $product)) {
                    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                        move_uploaded_file($_FILES['image']['tmp_name'],
                            $_SERVER['DOCUMENT_ROOT'] . "/template/images/{$_FILES['image']['name']}");
                    }
                }

                header("Location: /admin/product/1");
            }
        }

        require_once ROOT . '/views/admin_product/update.php';
        return true;
    }
}
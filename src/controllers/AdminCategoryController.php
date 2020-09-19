<?php

class AdminCategoryController extends AdminBase
{
    /**
     * Categories list
     * @return bool
     */
    public function actionIndex()
    {
        self::checkAdmin();
        $categories = Category::getCategories(true);
        require_once ROOT . '/views/admin_category/index.php';
        return true;
    }

    /**
     * Create category
     */
    public function actionCreate()
    {
        self::checkAdmin();
        $categories = Category::getCategories();

        $sortOrder = 0;
        foreach ($categories as $item) {
            if ($sortOrder < $item['sort_order']) $sortOrder = $item['sort_order'];
        }

        $category['title'] = 'Нова категорія';
        $category['visibility'] = 0;
        $category['sort_order'] = $sortOrder + 1;

        $id = Category::createCategory($category);
        header("Location: /admin/category");
    }

    /**
     * Remove category
     * @param $id
     */
    public function actionDelete($id)
    {
        self::checkAdmin();
        Category::deleteCategory($id);
        header("Location: /admin/category");
    }

    /**
     * Update category
     * @param $id
     * @return bool
     */
    public function actionUpdate($id)
    {
        self::checkAdmin();
        $category = Category::getCategory($id);
        $errors = false;

        if (isset($_POST['submit'])) {
            $category['title'] = $_POST['title'];
            $category['visibility'] = 0;
            if (array_key_exists('visibility', $_POST)) $category['visibility'] = $_POST['visibility'];

            if (!isset($category['title']) || empty($category['title']) || !User::checkLength($category['title'], 3)) {
                $errors[] = 1;
            }

            if (!$errors) {
                Category::updateCategory($id, $category);
                header("Location: /admin/category");
            }
        }

        require_once ROOT . '/views/admin_category/update.php';
        return true;
    }
}
<?php

class AdminUserController extends AdminBase
{
    /**
     * Show users
     * @return bool
     */
    public function actionIndex()
    {
        self::checkAdmin();
        $users = User::getUsers();
        require_once ROOT . '/views/admin_user/index.php';
        return true;
    }

    /**
     * Show user
     * @param $userId
     * @param $categoryId
     * @return bool
     */
    public function actionView($userId, $categoryId, $page = 1)
    {
        self::checkAdmin();
        $user = User::getUser($userId);
        $page = intval(substr($page, 5));
        if (!$page) $page = 1;

        $discounts = Discount::index($userId);
        $categories = Category::getCategories();
        $products = Product::getProductsForAdmin(20, $page, $categoryId);
        $total = Product::adminProductsCount($categoryId);
        $pagination = new Pagination($total, $page, 20, 'page-');
        $fmt = numfmt_create( 'uk_UA', NumberFormatter::CURRENCY );
        $discountValue = 0;

        require_once ROOT . '/views/admin_user/view.php';
        return true;
    }

    public function actionUpdate()
    {
        self::checkAdmin();
        User::updateUserDiscount($_POST['user_id'], $_POST['user_discount']);
        return true;
    }

    public function actionRestaurant()
    {
        User::restaurant($_POST['userId'], $_POST['role']);
        return true;
    }
}
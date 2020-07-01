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
    public function actionView($userId, $categoryId)
    {
        self::checkAdmin();
        $user = User::getUser($userId);

        $discounts = Discount::index(8);
        $categories = Category::getCategories();
        $products = Product::getProductsForAdmin(20, 1, $categoryId);
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
}
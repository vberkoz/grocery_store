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
     * @return bool
     */
    public function actionView($userId)
    {
        self::checkAdmin();
        $user = User::getUser($userId);
        $orders = Order::getUserOrders($userId);
        $fmt = numfmt_create( 'uk_UA', NumberFormatter::CURRENCY );
        $products = Order::getUserProducts($userId);
        $total = 0;
        foreach ($products as $product) {
            $total += $product['price'];
        }
//        echo '<pre>';print_r($products);die;
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
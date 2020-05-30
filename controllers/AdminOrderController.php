<?php

class AdminOrderController extends AdminBase
{
    /**
     * Show orders list
     * @return bool
     */
    public function actionIndex()
    {
        self::checkAdmin();
        $orders = Order::getOrders();
        require_once ROOT . '/views/admin_order/index.php';
        return true;
    }

    /**
     * Show single order
     * @param $id
     * @return bool
     */
    public function actionView($id)
    {
        self::checkAdmin();
        $order = Order::getOrder($id);
        if ($order['user_id']) {
            $user = User::getUser($order['user_id']);
            $discount = $user['discount'];
        } else {
            $discount = 0;
        }

        $fmt = numfmt_create( 'uk_UA', NumberFormatter::CURRENCY );
        $productsCount = json_decode($order['bag'], true);
        $productsIds = array_keys($productsCount);

        $products = json_decode($order['bag'], true);
        $bag = Product::getProductsByIds(array_keys($products), array_values($products));
        $order['total'] = $bag['total'];
        $discount = $order['total'] * ($discount * 0.01);
        $total = $order['total'] - $discount;
        unset($bag['total']);
        $order['bag'] = $bag;

        if (isset($_POST['submit'])) {
            Order::update($id, $_POST['order_status']);
            header("Location: /admin/order");
        }

        require_once ROOT . '/views/admin_order/view.php';
        return true;
    }

    /**
     * Updates order status
     * @return bool
     */
    public function actionUpdate()
    {
        self::checkAdmin();
        Order::update($_POST['order_id'], $_POST['order_status']);
        return true;
    }
}
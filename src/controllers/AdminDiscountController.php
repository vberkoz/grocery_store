<?php

class AdminDiscountController
{
    public function actionCurrency()
    {
        $userId = $_POST['userId'];
        $productId = $_POST['productId'];
        $currency = $_POST['currency'];
        $r = Discount::update($userId, $productId, $currency, 'currency');
        echo json_encode($r);
        return true;
    }

    public function actionPercent()
    {
        $userId = $_POST['userId'];
        $productId = $_POST['productId'];
        $percent = $_POST['percent'];
        $r = Discount::update($userId, $productId, $percent, 'percent');
        echo json_encode($r);
        return true;
    }
}
<?php

class AdminDiscountController
{
    public function actionUpdate()
    {
        $userId = $_POST['userId'];
        $productId = $_POST['productId'];
        $discount = $_POST['discount'];
        $r = Discount::update($userId, $productId, $discount);
        echo json_encode($r);
        return true;
    }
}
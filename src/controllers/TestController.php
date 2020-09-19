<?php

class TestController
{
    public function actionIndex()
    {
        echo '<pre>';print_r(Order::distinctProducts(2));
        return true;
    }
}
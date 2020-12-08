<?php

include_once 'CartService.php';

class CartController
{
    public function index()
    {
        echo json_encode(CartService::index());
        return true;
    }

    public function content()
    {
        echo json_encode(CartService::content());
        return true;
    }

    public function summary()
    {
        echo json_encode(CartService::summary());
        return true;
    }

    public function update()
    {
        echo CartService::update($_POST['id'], $_POST['quantity']);
        return true;
    }

    public function checkout()
    {
        echo json_encode(CartService::checkout($_POST['data']));
        return true;
    }
}

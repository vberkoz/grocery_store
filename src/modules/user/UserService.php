<?php

include_once 'User.php';

class UserService
{
    public static function orders($d)
    {
        $userId = $d['userId'];
        $orders = Utils::storage([
            'columns' => '*',
            'table' => 'carts',
            'conditions' => "user_id = '$userId'"
        ]);
        foreach ($orders as $k => $i) {
            $cartId = $i['id'];
            $orders[$k]['products'] = Utils::storage([
                'columns' => '*',
                'table' => 'cart_products',
                'joins' => [
                    [
                        'table' => 'product_details',
                        'expresion' => 'cart_products.product_id = product_details.product_id'
                    ],
                    [
                        'table' => 'products',
                        'expresion' => 'cart_products.product_id = products.id'
                    ]
                ],
                'conditions' => "cart_id = '$cartId'"
            ]);
        }
        return $orders;
    }

    public static function logout()
    {
        unset($_SESSION['user']);
    }

    public static function login($d)
    {
        $email = $d['email'];
        $secret = $d['secret'];
        $user = User::one([
            'columns' => 'id, secret',
            'table' => 'users',
            'conditions' => "email = '$email'"
        ]);
        if (password_verify($secret, $user['secret'])) {
            $_SESSION['user'] = $user['id'];
            return $user['id'];
        }
        return false;
    }

    public static function logged()
    {
        if (isset($_SESSION['user'])) return $_SESSION['user'];
        return null;
    }
}

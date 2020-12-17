<?php

include_once 'User.php';

class UserService
{
    public static function orders($d)
    {
        $userId = $d['userId'];
        $orders = Utils::storage([
            'columns' => "*",
            'table' => 'carts',
            'conditions' => "user_id = '$userId'",
            'affect' => 'many'
        ]);
        foreach ($orders as $k => $i) {
            $cartId = $i['id'];
            $orders[$k]['products'] = Utils::storage([
                'columns' => '
                    cart_products.price,
                    cart_products.quantity,
                    product_details.title,
                    product_details.image,
                    product_details.unit,
                    products.volume,
                    products.id
                ',
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
        $users = Utils::storage([
            'columns' => 'id, secret',
            'table' => 'users',
            'conditions' => "email = '$email'"
        ]);
        $user = $users[0];
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

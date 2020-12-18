<?php

include_once 'User.php';

class UserService
{
    public static function orders($d)
    {
        $userId = $d['userId'];
        $lang = $d['lang'];
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
                    product_'.$lang.'_details.title,
                    product_'.$lang.'_details.img,
                    product_'.$lang.'_details.unit,
                    products.vol,
                    products.id
                ',
                'table' => 'cart_products',
                'joins' => [
                    [
                        'table' => 'product_'.$lang.'_details',
                        'expresion' => 'cart_products.product_id = product_'.$lang.'_details.prod_id'
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

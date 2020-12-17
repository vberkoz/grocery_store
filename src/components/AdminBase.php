<?php

abstract class AdminBase
{
    /**
     * Checks if user is admin
     * @return bool
     */
    public static function checkAdmin()
    {
        $userId = User::checkLogged();
        $user = User::getUser($userId);

        if ($user['role'] == 'admin') {
            return true;
        }

        die('Access denied');
    }

    /**
     * Generates uuid
     * @return string
     */
    public static function generateProductId()
    {
        return sprintf( '%04x%04x', mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ));
    }

    public static function ordersBadges()
    {
        return [
            Order::ordersCount(0),
            Order::ordersCount(1),
            Order::ordersCount(2),
        ];
    }
}

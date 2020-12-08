<?php

include_once 'Cart.php';
include_once ROOT.'/components/Utils.php';
include_once ROOT.'/modules/product/Product.php';
include_once ROOT.'/modules/cart_product/CartProduct.php';

class CartService
{
    public static function checkout($data)
    {
        $data['hash'] = Utils::hash();
        $data['user_id'] = null;

        $summary = self::summary();
        $data['count'] = $summary['count'];
        $data['price'] = $summary['price'];
        $data['discount'] = 0;

        $cartId = Cart::insert($data);
        $items = self::content();
        CartProduct::insert($cartId, $items);

        return $data;
    }

    public static function summary()
    {
        $items = self::content();
        $price = 0;
        foreach ($items as $i) {
            $price += $i['total'];
        }

        $summary['count'] = self::countItems();
        $summary['price'] = $price;

        return $summary;
    }

    public static function content()
    {
        $ids = self::index();
        $params = implode("','", array_keys($ids));
        $params = "'$params'";
        $products = Product::selectByIdForCart($params);
        foreach ($products as $k => $v) {
            foreach ($ids as $id => $q) {
                if ($products[$k]['id'] == $id) {
                    $products[$k]['quantity'] = $q;
                    $products[$k]['total'] = $q * $products[$k]['price'];
                }
            }
        }
        return $products;
    }

    public static function index()
    {
        if (isset($_SESSION['products'])) return $_SESSION['products'];
        return [];
    }

    public static function countItems()
    {
        if (isset($_SESSION['products'])) {
            return count($_SESSION['products']);
        } else {
            return 0;
        }
    }

    public static function update($id, $quantity)
    {
        $bag = [];
        if (isset($_SESSION['products'])) $bag = $_SESSION['products'];
        if ($quantity) {
            $bag[$id] = $quantity;
        } else {
            unset($bag[$id]);
        }
        $_SESSION['products'] = $bag;
        return self::countItems();
    }
}

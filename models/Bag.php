<?php

class Bag
{
    /**
     * Adds product to bag and saves it into session
     * @param $id
     * @param $volume
     * @return int
     */
    public static function addProduct($id, $volume)
    {
        $bag = [];
        if (isset($_SESSION['products'])) $bag = $_SESSION['products'];
        $bag[$id] = $volume;
        $_SESSION['products'] = $bag;

        return self::countItems();
    }

    public static function changeProduct($id, $quantity)
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

    public static function reduceProduct($id, $volume)
    {
        $id = intval($id);
        $bag = [];
        if (isset($_SESSION['products'])) $bag = $_SESSION['products'];

        if (!$volume) {
            unset($bag[$id]);
        } else {
            $bag[$id] = $volume;
        }
        $_SESSION['products'] = $bag;

        return self::countItems();
    }

    /**
     * Removes product from bag by id
     * @param $id
     */
    public static function removeProduct($id)
    {
        $id = intval($id);
        unset($_SESSION['products'][$id]);
    }

    /**
     * Calculates products number in bag
     * @return int
     */
    public static function countItems()
    {
        if (isset($_SESSION['products'])) {
            return count($_SESSION['products']);
        } else {
            return 0;
        }
    }

    /**
     * Gets products from bag
     * @return array
     */
    public static function getProducts()
    {
        if (isset($_SESSION['products'])) return $_SESSION['products'];
        return [];
    }

    /**
     * Calculates products total price in bag
     * @param $products
     * @return float|int
     */
    public static function calculateTotalPrice($products)
    {
        $bag = self::getProducts();
        $total = 0;
        if ($bag) {
            foreach ($products as $item) {
                $total += $item['price'] * $bag[$item['id']];
            }
        }

        return $total;
    }

    /**
     * Clears bag
     */
    public static function clear()
    {
        if (isset($_SESSION['products'])) unset($_SESSION['products']);
    }
}
<?php

class OrderedProduct
{
    public static function saveBunch(
        int     $userId,
        int     $orderId,
        array   $products
    ): void {
        $sql = '';
        foreach ($products as $productId => $quantity) {
            $sql .= "INSERT INTO ordered_products (
                order_id, 
                product_id, 
                title, 
                quantity, 
                discount_client, 
                discount_restaurant, 
                price,
                unit
                )
            SELECT
                item.order_id,
                item.product_id,
                item.title,
                item.quantity,
                IFNULL(discount.currency, 0) AS discount_client, 
                IFNULL(discount.percent, 0) AS discount_restaurant,
                item.price,
                item.unit
            FROM (
                SELECT
                    $orderId AS order_id, 
                    $productId AS product_id, 
                    (SELECT title FROM products WHERE id = $productId) AS title,
                    $quantity AS quantity,
                    (SELECT price FROM products WHERE id = $productId) AS price,
                    (SELECT unit FROM products WHERE id = $productId) AS unit
            ) AS item 
            LEFT JOIN (
                SELECT product_id, currency, percent
                FROM discounts WHERE user_id = $userId AND product_id = $productId
            ) AS discount 
            ON item.product_id = discount.product_id;";
        }
        $db = Db::getConnection();
        $result = $db->query($sql);
        $result->execute();
    }

    public static function list(int $orderId): array
    {
        $sql = "SELECT
            product_id, 
            quantity, 
            title, 
            discount_client, 
            discount_restaurant, 
            price,
            unit
            FROM ordered_products
            WHERE order_id = $orderId";

        $db = Db::getConnection();
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        return $result->fetchAll();
    }
}
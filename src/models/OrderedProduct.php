<?php

class OrderedProduct
{
    public static function save(array $orderedProduct): void
    {
        $userId = $orderedProduct['user_id'];
        $orderId = $orderedProduct['order_id'];
        $productId = $orderedProduct['product_id'];
        $db = Db::getConnection();
        $r = $db->prepare('INSERT INTO ordered_products (
            order_id, 
            product_id, 
            title, 
            quantity, 
            discount_client, 
            discount_restaurant, 
            price,
            unit)
            SELECT
                :order_id AS order_id,
                :product_id AS product_id,
                products.title, 
                products.volume AS quantity, 
                IFNULL ((
                    SELECT currency 
                    FROM discounts 
                    WHERE user_id = :user_id
                    AND product_id = :product_id), 0) AS discount_client, 
                IFNULL ((
                    SELECT percent 
                    FROM discounts 
                    WHERE user_id = :user_id
                    AND product_id = :product_id), 0) AS discount_restaurant,
                products.price, 
                products.unit
            FROM products 
            WHERE products.id = :product_id');

        $r->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $r->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $r->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $r->execute();
    }

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

    public static function update(int $orderId, int $productId, float $quantity):bool
    {
        $db = Db::getConnection();
        $result = $db->prepare('UPDATE ordered_products 
            SET quantity = :quantity 
            WHERE order_id = :order_id AND product_id = :product_id');
        $result->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $result->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $result->bindParam(':quantity', $quantity, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function remove(int $orderId, int $productId): bool
    {
        $db = Db::getConnection();
        $r = $db->prepare('DELETE FROM ordered_products WHERE order_id = :order_id AND product_id = :product_id');
        $r->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $r->bindParam(':product_id', $productId, PDO::PARAM_INT);
        return $r->execute();
    }
}
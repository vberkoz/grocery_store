<?php

class Order
{
    private static $orders_sql = [
        "SELECT * FROM orders
        WHERE created_at > CONCAT(CURDATE(), ' 4:00:00');",
        "SELECT * FROM orders
        WHERE created_at >= CONCAT(SUBDATE(CURDATE(), INTERVAL 1 DAY), ' 4:00:00')
        AND created_at < CONCAT(CURDATE(), ' 4:00:00');",
        "SELECT * FROM orders ORDER BY created_at DESC"
    ];

    /**
     * Gets orders list
     * @return array
     */
    public static function getOrders()
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT * FROM orders ORDER BY created_at DESC");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetchAll();
    }

    /**
     * Get order by id
     * @param $id
     * @return mixed
     */
    public static function getOrder($id)
    {
        $db = Db::getConnection();
        $sql = "SELECT * FROM orders WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetch();
    }

    public static function history(int $userId): array
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT
            id,
            order_id,
            user_name,
            user_phone,
            user_address,
            created_at,
            IF(orders.created_at > CONCAT(CURDATE(), ' 4:00:00'), TRUE, FALSE) as editable
        FROM orders WHERE user_id = $userId ORDER BY created_at DESC");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $orders = $result->fetchAll();

        foreach ($orders as $key => $order) {
            $orderId = $order['id'];
            $result = $db->query("SELECT
                ordered_products.*,
                products.image,
                products.volume,
                products.volume_min
            FROM ordered_products
            LEFT JOIN products
            ON ordered_products.product_id = products.id
            WHERE order_id = $orderId");
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $orders[$key]['products'] = $result->fetchAll();
        }

        return $orders;
    }

    public static function orders($period)
    {
        $db = Db::getConnection();
        $result = $db->query(self::$orders_sql[$period]);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $orders = $result->fetchAll();

        $products = [];
        foreach ($orders as $key => $order) {
            $orders[$key]['products'] = OrderedProduct::list($order['id']);
        }
        return $orders;
    }

    public static function ordersCount($period)
    {
        $db = Db::getConnection();
        $result = $db->query(self::$orders_sql[$period]);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $orders = $result->fetchAll();
        return count($orders);
    }

    public static function distinctProducts($period)
    {
        $orders = self::orders($period);
        $products = [];
        foreach ($orders as $order) {
            $orderProducts = json_decode($order['bag'], true);
            $bagProducts = Product::getProductsByIds(array_keys($orderProducts), array_values($orderProducts));
            unset($bagProducts['total']);
            foreach ($bagProducts as $bagProduct) {
                $products[] = $bagProduct;
            }
        }

        $distinct_products = [];
        $present = false;
        foreach ($products as $product) {
            foreach ($distinct_products as $key => $distinct_product) {
                if ($distinct_product['id'] == $product['id']) {
                    $present = true;
                    $distinct_products[$key]['quantity'] += $product['quantity'];
                    $distinct_products[$key]['volume'] = $product['volume'] * $distinct_products[$key]['quantity'];
                    $distinct_products[$key]['price'] = $product['price'] * $distinct_products[$key]['quantity'];
                }
            }
            if (!$present) $distinct_products[] = $product;
            $present = false;
        }

        return $distinct_products;
    }

    public static function getUserProducts($userId = 0)
    {
        $db = Db::getConnection();
        if ($userId) {
            $sql = "SELECT * FROM orders WHERE user_id = :user_id";
        } else {
            $sql = "SELECT * FROM orders";
        }

        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $products = [];
        while ($row = $result->fetch()) {
            $orderProducts = json_decode($row['bag'], true);
            $bag = Product::getProductsByIds(array_keys($orderProducts), array_values($orderProducts));
            unset($bag['total']);
            foreach ($bag as $item) {
                unset($item['product_id']);
                unset($item['category_id']);
                unset($item['item_total']);
                $products[] = $item;
            }
        }

        $distinct_products = [];
        $present = false;
        foreach ($products as $product) {
            foreach ($distinct_products as $key => $distinct_product) {
                if ($distinct_product['id'] == $product['id']) {
                    $present = true;
                    $distinct_products[$key]['quantity'] += $product['quantity'];
                    $distinct_products[$key]['volume'] = $product['volume'] * $distinct_products[$key]['quantity'];
                    $distinct_products[$key]['price'] = $product['price'] * $distinct_products[$key]['quantity'];
                }
            }
            if (!$present) $distinct_products[] = $product;
            $present = false;
        }

        return $distinct_products;
    }

    /**
     * Saves order into database
     * @param $userName
     * @param $userPhone
     * @param $userComment
     * @param $userAddress
     * @param $bag
     * @param $discount
     * @param $userId
     * @return bool
     */
    public static function save(
        $userName, 
        $userPhone, 
        $userComment, 
        $userAddress, 
        $products, 
        $discount, 
        $userId
    ) {
        $userId = intval($userId);
        $db = Db::getConnection();
        $sql = 'INSERT INTO orders (order_id, user_name, user_phone, user_comment, user_address, user_id, bag, discount) 
                VALUES (:order_id, :user_name, :user_phone, :user_comment, :user_address, :user_id, :bag, :discount)';

        $bag = json_encode($products);
        $orderHash = PublicBase::makeHash();

        $result = $db->prepare($sql);
        $result->bindParam(':order_id', $orderHash, PDO::PARAM_STR);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':user_address', $userAddress, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->bindParam(':bag', $bag, PDO::PARAM_STR);
        $result->bindParam(':discount', $discount, PDO::PARAM_STR);
        $result->execute();
        $orderId = $db->lastInsertId();
        
        OrderedProduct::saveBunch($userId, $orderId, $products);

        return $orderId;
    }

    /**
     * Delete order by id
     * @param $id
     * @return bool
     */
    public static function delete($id)
    {
        $db = Db::getConnection();
        $sql = 'DELETE FROM orders WHERE id = :id;
        DELETE FROM ordered_products WHERE order_id = :id;';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
}
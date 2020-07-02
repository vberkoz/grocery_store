<?php

class Order
{
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

    /**
     * Get orders by user id
     * @param $userId
     * @return array
     */
    public static function getUserOrders($userId)
    {
        $db = Db::getConnection();
        $sql = "SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC";
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $i = 0;
        $orders = [];
        while ($row = $result->fetch()) {
            $orders[$i]['id'] = $row['id'];
            $orders[$i]['user_name'] = $row['user_name'];
            $orders[$i]['user_phone'] = $row['user_phone'];
            $orders[$i]['user_comment'] = $row['user_comment'];
            $orders[$i]['user_id'] = $row['user_id'];
            $orders[$i]['order_id'] = $row['order_id'];
            $orders[$i]['discount'] = $row['discount'];
            $orders[$i]['created_at'] = date('Y-m-d H:i:s', strtotime($row['created_at']));
            $products = json_decode($row['bag'], true);
            $bag = Product::getProductsByIds(array_keys($products), array_values($products));
            $orders[$i]['total'] = $bag['total'];
            unset($bag['total']);
            $orders[$i]['bag'] = $bag;
            $orders[$i]['user_address'] = $row['user_address'];
            $i++;
        }
        return $orders;
    }

    public static function yesterdayOrders()
    {
        $db = Db::getConnection();
        $result = $db->query("
            SELECT *
            FROM orders
            WHERE created_at >= CONCAT(SUBDATE(CURDATE(), INTERVAL 1 DAY), ' 4:00:00')
            AND created_at < CONCAT(CURDATE(), ' 4:00:00');
        ");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $orders = $result->fetchAll();
        $products = [];
        foreach ($orders as $key => $order) {
            $orderProducts = json_decode($order['bag'], true);
            $bagProducts = Product::getProductsByIds(array_keys($orderProducts), array_values($orderProducts));
            unset($bagProducts['total']);
            $orders[$key]['products'] = $bagProducts;
        }
        return $orders;
    }

    public static function yesterdayProducts()
    {
        $orders = self::yesterdayOrders();
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
     * @param $userId
     * @param $bag
     * @param $discount
     * @return bool
     */
    public static function save($userName, $userPhone, $userComment, $userAddress, $userId, $bag, $discount)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO orders (order_id, user_name, user_phone, user_comment, user_address, user_id, bag, discount) 
                VALUES (:order_id, :user_name, :user_phone, :user_comment, :user_address, :user_id, :bag, :discount)';

        $bag = json_encode($bag);
        $orderId = PublicBase::makeHash();

        $result = $db->prepare($sql);
        $result->bindParam(':order_id', $orderId, PDO::PARAM_STR);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':user_address', $userAddress, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $result->bindParam(':bag', $bag, PDO::PARAM_STR);
        $result->bindParam(':discount', $discount, PDO::PARAM_STR);

        return $result->execute();
    }

    /**
     * Delete order by id
     * @param $id
     * @return bool
     */
    public static function delete($id)
    {
        $db = Db::getConnection();
        $sql = 'DELETE FROM orders WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
}
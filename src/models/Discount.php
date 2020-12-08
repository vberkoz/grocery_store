<?php

class Discount
{
    public static function index($userId)
    {
        $db = Db::getConnection();
        $sql = "SELECT * FROM discounts WHERE user_id = :user_id";

        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetchAll();
    }

    public static function update($userId, $productId, $value, $type)
    {
        $db = Db::getConnection();
        $sql = "SELECT id FROM discounts WHERE user_id = :user_id AND product_id = :product_id";

        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        if ($row = $result->fetch()) {
            switch ($type) {
                case 'currency':
                    $sql = 'UPDATE discounts SET user_id = :user_id, product_id = :product_id, currency = :currency WHERE id = :id';
                    $result = $db->prepare($sql);
                    $result->bindParam(':currency', $value, PDO::PARAM_STR);
                    break;
                case 'percent':
                    $sql = 'UPDATE discounts SET user_id = :user_id, product_id = :product_id, percent = :percent WHERE id = :id';
                    $result = $db->prepare($sql);
                    $result->bindParam(':percent', $value, PDO::PARAM_STR);
                    break;
            }
            $result->bindParam(':id', $row['id'], PDO::PARAM_INT);
        } else {
            switch ($type) {
                case 'currency':
                    $sql = 'INSERT INTO discounts (user_id, product_id, currency) VALUES (:user_id, :product_id, :currency)';
                    $result = $db->prepare($sql);
                    $result->bindParam(':currency', $value, PDO::PARAM_STR);
                    break;
                case 'percent':
                    $sql = 'INSERT INTO discounts (user_id, product_id, percent) VALUES (:user_id, :product_id, :percent)';
                    $result = $db->prepare($sql);
                    $result->bindParam(':percent', $value, PDO::PARAM_STR);
                    break;
            }
        }
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $result->execute();

        return $row['id'];
    }
}
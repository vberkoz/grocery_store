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

    public static function update($userId, $productId, $discount)
    {
        $db = Db::getConnection();
        $sql = "SELECT id FROM discounts WHERE user_id = :user_id AND product_id = :product_id";

        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        if ($row = $result->fetch()) {
            $sql = 'UPDATE discounts 
                    SET user_id = :user_id, 
                        product_id = :product_id, 
                        discount = :discount 
                    WHERE id = :id';
            $result = $db->prepare($sql);
            $result->bindParam(':id', $row['id'], PDO::PARAM_INT);
            $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $result->bindParam(':product_id', $productId, PDO::PARAM_INT);
            $result->bindParam(':discount', $discount, PDO::PARAM_STR);
            $result->execute();
        } else {
            $sql = 'INSERT INTO discounts (user_id, product_id, discount) 
                    VALUES (:user_id, :product_id, :discount)';
            $result = $db->prepare($sql);
            $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $result->bindParam(':product_id', $productId, PDO::PARAM_INT);
            $result->bindParam(':discount', $discount, PDO::PARAM_STR);
            $result->execute();
        }

        return $row['id'];
    }
}
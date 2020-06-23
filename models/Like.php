<?php

class Like
{
    public static function userLikes($userId)
    {
        $db = Db::getConnection();
        $sql = ("SELECT
                  products.id as id, 
                  title, 
                  category_id, 
                  price, 
                  availability, 
                  visibility, 
                  image, 
                  volume, 
                  volume_min, 
                  unit 
                FROM likes 
                LEFT JOIN products 
                ON likes.product_id = products.id 
                WHERE user_id = :user_id");
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetchAll();
    }

    public static function userLikesIds($userId)
    {
        $db = Db::getConnection();
        $sql = ("SELECT product_id FROM likes WHERE user_id = :user_id");
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $i = 0;
        $ids = [];
        while ($row = $result->fetch()) {
            $ids[$i] = $row['product_id'];
            $i ++;
        }
        return $ids;
    }

    public static function add($userId, $productId)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO likes (user_id, product_id) VALUES (:user_id, :product_id)';
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->bindParam(':product_id', $productId, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function delete($productId) {
        $db = Db::getConnection();
        $sql = 'DELETE FROM likes WHERE product_id = :product_id';
        $result = $db->prepare($sql);
        $result->bindParam(':product_id', $productId, PDO::PARAM_INT);
        return $result->execute();
    }
}
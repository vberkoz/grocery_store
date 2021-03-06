<?php

class Category
{
    /**
     * Gets single category by id
     * @param $categoryId
     * @return mixed
     */
    public static function getCategory($categoryId)
    {
        $categoryId = intval($categoryId);

        if ($categoryId) {
            $db = Db::getConnection();

            $result = $db->query("SELECT * FROM categories WHERE id = $categoryId");
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();
        }

        return false;
    }

    /**
     * Get categories list
     * @return array
     */
    public static function getCategories($adminArea = false)
    {
        $db = Db::getConnection();
        if ($adminArea) {
            $sql = "SELECT * FROM categories WHERE id <> 1 ORDER BY sort_order ASC";
        } else {
            $sql = "SELECT * FROM categories WHERE visibility = 1 ORDER BY sort_order ASC";
        }

        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetchAll();
    }

    /**
     * Creates category by parameters array
     * @param $category
     * @return int|string
     */
    public static function createCategory($category)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO categories (title, sort_order, visibility)
                VALUES (:title, :sort_order, :visibility)';

        $result = $db->prepare($sql);
        $result->bindParam(':title', $category['title'], PDO::PARAM_STR);
        $result->bindParam(':sort_order', $category['sort_order'], PDO::PARAM_INT);
        $result->bindParam(':visibility', $category['visibility'], PDO::PARAM_INT);

        if ($result->execute()) return $db->lastInsertId();
        return 0;
    }

    /**
     * Deletes category by id
     * @param $id
     * @return bool
     */
    public static function deleteCategory($id)
    {
        $id = intval($id);

        $db = Db::getConnection();

        $sql = 'DELETE FROM categories WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    /**
     * Updates category by id and parameters array
     * @param $id
     * @param $category
     * @return bool
     */
    public static function updateCategory($id, $category)
    {
        $db = Db::getConnection();
        $sql = 'UPDATE categories 
                SET 
                  title = :title,
                  sort_order = :sort_order,
                  visibility = :visibility
                WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':title', $category['title'], PDO::PARAM_STR);
        $result->bindParam(':sort_order', $category['sort_order'], PDO::PARAM_INT);
        $result->bindParam(':visibility', $category['visibility'], PDO::PARAM_INT);

        return $result->execute();
    }
}
<?php

class Post
{

    /**
     * Returns single article with specified id
     * @param $id
     * @return mixed
     */
    public static function single($id)
    {
        $id = intval($id);
        $db = Db::getConnection();

        $result = $db->query("SELECT * FROM posts WHERE id=$id");
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $newsItem = $result->fetch();

        return $newsItem;
    }

    /**
     * Get posts list
     * @return mixed
     */
    public static function index()
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT id, title, excerpt, created_at
                                       FROM posts
                                       ORDER BY created_at DESC 
                                       LIMIT 10");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetchAll();
    }

}
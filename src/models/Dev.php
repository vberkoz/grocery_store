<?php

class Dev
{
    static public function getProducts()
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM products';

        $r = $db->prepare($sql);
        $r->setFetchMode(PDO::FETCH_ASSOC);
        $r->execute();

        return $r->fetchAll();
    }

    static public function getProductsWithIdTitleSlug()
    {
        $db = Db::getConnection();
        $sql = 'SELECT id, title, slug FROM products';

        $r = $db->prepare($sql);
        $r->setFetchMode(PDO::FETCH_ASSOC);
        $r->execute();

        return $r->fetchAll();
    }

    static public function executeSQL(string $sql): void
    {
        $db = Db::getConnection();
        $r = $db->prepare($sql);
        $r->execute();
    }
}

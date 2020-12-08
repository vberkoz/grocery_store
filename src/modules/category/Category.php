<?php


class Category
{
    public static function selectOne(int $id)
    {
        $db = Db::getConnection();
        $sql = "SELECT * FROM categories WHERE id = $id";
        $r = $db->prepare($sql);
        $r->setFetchMode(PDO::FETCH_ASSOC);
        $r->execute();
        return $r->fetch();
    }

    public static function selectAll(): array
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM categories';
        $r = $db->prepare($sql);
        $r->setFetchMode(PDO::FETCH_ASSOC);
        $r->execute();
        return $r->fetchAll();
    }

    public static function updateAll(array $categories): void
    {
        $db = Db::getConnection();
        $sql = '';
        foreach ($categories as $item) {
            $id = $item['id'];
            $title = $item['title'];
            $slug = $item['slug'];
            $visible = $item['visible'];
            $sql .= "UPDATE categories 
                     SET title = '$title', slug = '$slug', visible = $visible
                     WHERE id = $id;";
        }

        $r = $db->prepare($sql);
        $r->execute();
    }

    public static function insert(): array
    {
        $db = Db::getConnection();
        $sql = "INSERT INTO categories (title, slug, visible)
                VALUES ('Нова категорія', 'nova-kategoriya', 0)";
        $r = $db->prepare($sql);
        $r->execute();

        $id = $db->lastInsertId();
        $sql = "SELECT * FROM categories WHERE id = $id";
        $r = $db->prepare($sql);
        $r->setFetchMode(PDO::FETCH_ASSOC);
        $r->execute();
        return $r->fetch();
    }

    public static function deleteSelected(string $ids): void
    {
        $db = Db::getConnection();
        $sql = "DELETE FROM categories WHERE id IN ($ids)";
        $r = $db->prepare($sql);
        $r->execute();
    }
}

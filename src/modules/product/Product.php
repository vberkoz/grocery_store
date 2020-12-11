<?php

include_once ROOT.'/components/Utils.php';

class Product
{
    public static function selectNew()
    {
        $db = Db::getConnection();
        $s = "
            SELECT 
                product_details.language,
                product_details.title,
                product_details.slug,
                product_details.image,
                product_details.unit,
                products.id,
                products.category_id,
                products.price,
                products.volume,
                products.volume_min,
                categories.title AS category,
                categories.slug AS category_slug
            FROM products
            LEFT JOIN product_details ON products.id = product_details.product_id
            LEFT JOIN categories ON products.category_id = categories.id
            WHERE products.visible = 1 LIMIT 20";
        $r = $db->prepare($s);
        $r->setFetchMode(PDO::FETCH_ASSOC);
        $r->execute();
        return $r->fetchAll();
    }

    public static function selectPopular()
    {
        $db = Db::getConnection();
        $s = "
            SELECT
                product_details.language,
                product_details.title,
                product_details.slug,
                product_details.image,
                product_details.unit,
                products.id,
                products.price,
                products.volume,
                products.volume_min,
                cp.num
            FROM (SELECT
                    product_id AS pid, 
                    COUNT(product_id) AS num
                FROM cart_products
                GROUP BY pid) AS cp 
            LEFT JOIN products ON products.id = cp.pid
            LEFT JOIN product_details ON product_details.product_id = cp.pid
            ORDER BY cp.num DESC
            LIMIT 20";
        $r = $db->prepare($s);
        $r->setFetchMode(PDO::FETCH_ASSOC);
        $r->execute();
        return $r->fetchAll();
    }

    public static function selectByTerm($term)
    {
        $db = Db::getConnection();
        $s = "SELECT title, slug FROM product_details WHERE title LIKE '$term%' LIMIT 5";
        $r = $db->prepare($s);
        $r->setFetchMode(PDO::FETCH_ASSOC);
        $r->execute();
        return $r->fetchAll();
    }

    public static function selectByIdForCart($ids)
    {
        $db = Db::getConnection();
        $sql = "
            SELECT 
                product_details.title,
                product_details.slug,
                product_details.image,
                product_details.unit,
                products.id,
                products.price,
                products.volume,
                products.volume_min
            FROM products
            LEFT JOIN product_details ON products.id = product_details.product_id
            WHERE products.id IN ($ids)";
        $r = $db->prepare($sql);
        $r->setFetchMode(PDO::FETCH_ASSOC);
        $r->execute();
        return $r->fetchAll();
    }

    public static function selectByCategory($category_id)
    {
        $db = Db::getConnection();
        $sql = "
            SELECT 
                product_details.language,
                product_details.title,
                product_details.slug,
                product_details.image,
                product_details.unit,
                products.id,
                products.category_id,
                products.price,
                products.volume,
                products.volume_min,
                categories.title AS category,
                categories.slug AS category_slug
            FROM products
            LEFT JOIN product_details ON products.id = product_details.product_id
            LEFT JOIN categories ON products.category_id = categories.id
            WHERE products.category_id = $category_id AND products.visible = 1";
        $r = $db->prepare($sql);
        $r->setFetchMode(PDO::FETCH_ASSOC);
        $r->execute();
        return $r->fetchAll();
    }

    public static function selectAll(): array
    {
        $db = Db::getConnection();
        $sql = "
            SELECT 
                products.id,
                products.visible,
                products.price,
                product_details.title,
                categories.title AS category
            FROM products
            LEFT JOIN product_details ON products.id = product_details.product_id
            LEFT JOIN categories ON products.category_id = categories.id
            ORDER BY id DESC";
        $r = $db->prepare($sql);
        $r->setFetchMode(PDO::FETCH_ASSOC);
        $r->execute();
        return $r->fetchAll();
    }

    public static function selectOne(int $id): array
    {
        $db = Db::getConnection();
        $sql = "
            SELECT 
                product_details.language,
                product_details.title,
                product_details.slug,
                product_details.image,
                product_details.description,
                product_details.characteristics,
                product_details.unit,
                products.id,
                products.category_id,
                products.code,
                products.price,
                products.visible,
                products.volume,
                products.volume_min,
                categories.title AS category,
                categories.slug AS category_slug
            FROM products
            LEFT JOIN product_details ON products.id = product_details.product_id
            LEFT JOIN categories ON products.category_id = categories.id
            WHERE products.id = $id";
        $r = $db->prepare($sql);
        $r->setFetchMode(PDO::FETCH_ASSOC);
        $r->execute();
        return $r->fetch();
    }

    public static function update(array $product)
    {
        $db = Db::getConnection();
        $id = $product['id'];
        $category_id = $product['category_id'];
        $code = $product['code'];
        $price = $product['price'];
        $visible = $product['visible'];
        $volume = $product['volume'];
        $volume_min = $product['volume_min'];

        $language = $product['language'];
        $title = $product['title'];
        $slug = $product['slug'];
        $image = $product['image'];
        $description = $product['description'];
        $characteristics = $product['characteristics'];
        $unit = $product['unit'];

        $sql = "UPDATE products
                SET
                    category_id = $category_id,
                    code = '$code',
                    price = $price,
                    visible = $visible,
                    volume = $volume,
                    volume_min = $volume_min
                WHERE id = $id;
                UPDATE product_details
                SET
                    language = '$language',
                    title = '$title',
                    slug = '$slug',
                    image = '$image',
                    description = '$description',
                    characteristics = '$characteristics',
                    unit = '$unit'
                WHERE product_id = $id;";
        $r = $db->prepare($sql);
        $r->execute();

        return self::selectOne($id);
    }

    public static function insert(): array
    {
        $db = Db::getConnection();
        $hash = Utils::hash();
        $sql = "INSERT INTO products (category_id, code, price, visible, volume, volume_min)
                VALUES (1, '$hash', 1, 0, 1, 0.1)";
        $r = $db->prepare($sql);
        $r->execute();

        $id = $db->lastInsertId();
        $sql = "INSERT INTO product_details (product_id, language, title, slug, image, description, characteristics, unit)
                VALUES ($id, 'ua', 'Новий товар', 'novij-tovar', 'novij-tovar.jpg', 
                        '<p>Корисна інформація про новий товар</p>', '{\"Характеристика\":\"значення\"}', 'кг')";
        $r = $db->prepare($sql);
        $r->execute();

        return self::selectOne($id);
    }

    public static function deleteSelected(string $ids): void
    {
        $db = Db::getConnection();
        $sql = "DELETE FROM products WHERE id IN ($ids)";
        $r = $db->prepare($sql);
        $r->execute();
    }

}

<?php

class Product
{
    const SHOW_BY_DEFAULT = 8;

    /**
     * Gets products list by category
     * @param int $count
     * @param int $page
     * @param int $categoryId
     * @return array
     */
    public static function getProducts(
        $count = self::SHOW_BY_DEFAULT, 
        $page = 1, 
        $categoryId = 1,
        $userId = 0
    ) {
        $count = intval($count);
        $categoryId = intval($categoryId);
        $offset = ($page - 1) * $count;

        $categorySQL = '';
        if ($categoryId > 1) {
            $categorySQL = "AND category_id = $categoryId ";
        }

        $db = Db::getConnection();

        $sql = "SELECT 
                    products.id AS id,
                    products.title, 
                    products.category_id,
                    products.product_id,
                    products.price,
                    products.availability,
                    products.visibility,
                    products.image,
                    products.volume,
                    products.volume_min,
                    products.unit,
                    discounts.currency,
                    discounts.percent,
                    discounts.user_id
                FROM products 
                LEFT JOIN 
                    (SELECT * FROM discounts WHERE user_id = $userId) AS discounts 
                    ON products.id = discounts.product_id
                WHERE visibility = 1 $categorySQL
                ORDER BY id DESC
                LIMIT $count OFFSET $offset";

        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetchAll();
    }

    /**
     * Gets products list for admin panel
     * @return array
     */
    public static function getProductsForAdmin($count = self::SHOW_BY_DEFAULT, $page = 1, $categoryId = 1)
    {
        $offset = ($page - 1) * $count;
        $db = Db::getConnection();
        if ($categoryId > 1) {
            $sql = "SELECT * FROM products WHERE category_id = $categoryId ORDER BY id DESC LIMIT $count OFFSET $offset";
        } else {
            $sql = "SELECT * FROM products ORDER BY id DESC LIMIT $count OFFSET $offset";
        }
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetchAll();
    }

    /**
     * Gets all recommended products
     * @return array
     */
    public static function getFeaturedProducts()
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT * FROM products WHERE visibility = 1 ORDER BY id DESC");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetchAll();
    }

    public static function find($searchTerm, $userId = 0)
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT 
            products.id AS id,
            products.title, 
            products.category_id,
            products.product_id,
            products.price,
            products.availability,
            products.visibility,
            products.image,
            products.volume,
            products.volume_min,
            products.unit,
            discounts.currency,
            discounts.percent,
            discounts.user_id
        FROM products 
        LEFT JOIN 
            (SELECT * FROM discounts WHERE user_id = $userId) AS discounts 
            ON products.id = discounts.product_id
        WHERE 
            visibility = 1 AND 
            availability = 1 AND 
            title LIKE '$searchTerm%'
        ORDER BY title DESC");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetchAll();
    }

    /**
     * Gets single product by id
     * @param $productId
     * @return mixed
     */
    public static function getProduct($productId) {
        $db = Db::getConnection();
        $result = $db->query("SELECT * FROM products WHERE id = $productId");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetch();
    }

    /**
     *
     * @param $idsArray
     * @return array
     */
    public static function getProductsByIds($idsArray, $quantity = false)
    {
        $db = Db::getConnection();
        $idsString = implode(',', $idsArray);

        $sql = "SELECT * FROM products WHERE availability = 1 AND id IN ($idsString)";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        if ($quantity) {
            $products = ['total' => 0];
        } else {
            $products = [];
        }
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['product_id'] = $row['product_id'];
            $products[$i]['title'] = $row['title'];
            $products[$i]['category_id'] = $row['category_id'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['image'] = $row['image'];
            $products[$i]['volume'] = $row['volume'];
            $products[$i]['volume_min'] = $row['volume_min'];
            $products[$i]['unit'] = $row['unit'];
            if ($quantity) {
                $products[$i]['quantity'] = $quantity[$i];
                $products[$i]['item_total'] = $row['price'] * $quantity[$i];
                $products['total'] += $row['price'] * $quantity[$i];
            }
            $i ++;
        }

        return $products;
    }

    /**
     * Gets products number in category
     * @param $categoryId
     * @return mixed
     */
    public static function getProductsNumber($categoryId)
    {
        $categoryId = intval($categoryId);

        $db = Db::getConnection();

        $categorySQL = '';
        if ($categoryId > 1) {
            $categorySQL = "AND category_id = $categoryId ";
        }

        $result = $db->query("SELECT count(id) AS count 
                                       FROM products 
                                       WHERE availability = 1 $categorySQL");

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        return $row['count'];
    }

    public static function adminProductsCount($categoryId)
    {
        $db = Db::getConnection();
        switch ($categoryId) {
            case 0:
            case 1:
                $sql = "SELECT COUNT(id) AS count FROM products";
                break;
            default:
                $sql = "SELECT COUNT(id) AS count FROM products WHERE category_id = $categoryId";
        }
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        return $row['count'];
    }

    /**
     * Creates product by parameters array
     * @param $product
     * @return int|string
     */
    public static function createProduct($product)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO products (
                    title, 
                    category_id, 
                    product_id, 
                    price, 
                    availability, 
                    visibility, 
                    image, 
                    volume, 
                    volume_min, 
                    unit
                ) VALUES (
                    :title, 
                    :category_id, 
                    :product_id, 
                    :price, 
                    :availability, 
                    :visibility, 
                    :image,
                    :volume, 
                    :volume_min, 
                    :unit
                )';

        $result = $db->prepare($sql);
        $result->bindParam(':title', $product['title'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $product['category_id'], PDO::PARAM_INT);
        $result->bindParam(':product_id', $product['product_id'], PDO::PARAM_STR);
        $result->bindParam(':price', $product['price'], PDO::PARAM_STR);
        $result->bindParam(':availability', $product['availability'], PDO::PARAM_INT);
        $result->bindParam(':visibility', $product['visibility'], PDO::PARAM_INT);
        $result->bindParam(':image', $product['image'], PDO::PARAM_STR);
        $result->bindParam(':volume', $product['volume'], PDO::PARAM_STR);
        $result->bindParam(':volume_min', $product['volume_min'], PDO::PARAM_STR);
        $result->bindParam(':unit', $product['unit'], PDO::PARAM_STR);

        if ($result->execute()) return $db->lastInsertId();
        return 0;
    }

    /**
     * Deletes product by id
     * @param $id
     * @return bool
     */
    public static function deleteProduct($id)
    {
        $id = intval($id);

        $db = Db::getConnection();

        $sql = 'DELETE FROM products WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    /**
     * Updates product by id and parameters array
     * @param $id
     * @param $product
     * @return bool
     */
    public static function updateProduct($id, $product)
    {
        $db = Db::getConnection();
        $sql = 'UPDATE products 
                SET 
                  image = :image,
                  title = :title,
                  category_id = :category_id,
                  product_id = :product_id,
                  price = :price,
                  volume = :volume,
                  volume_min = :volume_min,
                  unit = :unit,
                  availability = :availability,
                  visibility = :visibility
                WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':image', $product['image'], PDO::PARAM_STR);
        $result->bindParam(':title', $product['title'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $product['category_id'], PDO::PARAM_INT);
        $result->bindParam(':product_id', $product['product_id'], PDO::PARAM_STR);
        $result->bindParam(':price', $product['price'], PDO::PARAM_STR);
        $result->bindParam(':volume', $product['volume'], PDO::PARAM_STR);
        $result->bindParam(':volume_min', $product['volume_min'], PDO::PARAM_STR);
        $result->bindParam(':unit', $product['unit'], PDO::PARAM_STR);
        $result->bindParam(':availability', $product['availability'], PDO::PARAM_INT);
        $result->bindParam(':visibility', $product['visibility'], PDO::PARAM_INT);

        return $result->execute();
    }
}
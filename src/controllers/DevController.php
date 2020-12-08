<?php

class DevController extends AdminBase
{
    public function actionPopulateProductDetails()
    {
        $products = Dev::getProducts();
        $sql = "";
        $cnt = 0;

        foreach ($products as $item) {
            $cnt += 1;
            $product_id = $item['id'];
            $language = 'ua';
            $title = $item['title'];
            $slug = $item['slug'];
            $image = $item['slug'] . '.jpg';
            $description = $item['description'];
            $characteristics = '{}';
            $unit =  $item['unit'];
            $sql .= 'INSERT INTO product_details (
                             product_id,
                             language,
                             title,
                             slug,
                             image,
                             description,
                             characteristics,
                             unit
                             ) VALUES ('.
                                       $product_id.',"'.
                                       $language.'","'.
                                       $title.'","'.
                                       $slug.'","'.
                                       $image.'","'.
                                       $description.'","'.
                                       $characteristics.'","'.
                                       $unit.'"'.
                             ');';
            copy("template/images/{$item['image']}", "template/images/{$image}");
        }
        Dev::executeSQL($sql);

        echo '<pre>';
        print_r($cnt);
        print_r($sql);
//        print_r($products);
        return true;
    }

    public function actionTitleToSlug()
    {
        $products = Dev::getProductsWithIdTitleSlug();
        $sql = "";

        foreach ($products as $item) {
            $id = $item['id'];
            $slug = self::url_slug($item['title'], ['transliterate' => true]);
            $sql .= "UPDATE products SET slug = '$slug' WHERE id = $id;";
        }
        Dev::executeSQL($sql);

        echo '<pre>';print_r($sql);
        return true;
    }
}

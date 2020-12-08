<?php

include_once 'Category.php';
include_once ROOT.'/modules/product/Product.php';

class CategoryRenderer
{
    public static function details($category_id)
    {
        $products = Product::selectByCategory($category_id);
        $category = Category::selectOne($category_id);
        $pageTitle = $category['title'];
        $assets = '../assets';
        $directory = '/public';

        $details = include('details.php');
        $header = include(ROOT.'/ssr/layout/header.php');
        $footer = include(ROOT.'/ssr/layout/footer.php');

        $content = $header . $details . $footer;
        $filename = $category['slug'];
        $handle = fopen("public/category/$filename.html",'w+');
        fwrite($handle, $content);
        fclose($handle);
    }
}

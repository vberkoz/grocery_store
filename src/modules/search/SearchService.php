<?php

include_once ROOT.'/modules/product/Product.php';

class SearchService
{
    public static function full($term)
    {
        $items = Product::selectByTerm($term);
        foreach ($items as $k => $i) {
            $slug = $i['slug'];
            $items[$k]['link'] = "/public/product/$slug.html";
        }
        return $items;
    }
}

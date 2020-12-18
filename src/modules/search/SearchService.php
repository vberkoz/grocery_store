<?php

include_once ROOT.'/modules/product/Product.php';

class SearchService
{
    public static function full($p)
    {
        $term = $p['term'];
        $lang = $p['lang'];
        $items = Utils::storage([
            'columns' => 'title, slug',
            'table' => 'product_'.$lang.'_details',
            'joins' => [
                [
                    'table' => 'products',
                    'expresion' => 'products.id = product_'.$lang.'_details.prod_id'
                ]
            ],
            'conditions' => "
                visible = 1
                AND title LIKE '%$term%' LIMIT 5
            "
        ]);
        foreach ($items as $k => $i) {
            $slug = $i['slug'];
            $items[$k]['link'] = "/public/$lang/product/$slug.html";
        }
        return $items;
    }
}

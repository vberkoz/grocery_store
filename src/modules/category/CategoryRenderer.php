<?php

include_once 'Category.php';
include_once ROOT.'/modules/product/Product.php';

class CategoryRenderer
{
    public static function details($cat_id, $pages, $texts)
    {
        $langs = ['ua', 'en'];
        foreach ($langs as $lang) {
            $prods = Utils::storage([
                'columns' => '
                    products.id,
                    products.cat_id,
                    products.price,
                    products.vol,
                    products.vol_min,
                    product_'.$lang.'_details.title,
                    product_'.$lang.'_details.slug,
                    product_'.$lang.'_details.img,
                    product_'.$lang.'_details.unit,
                    category_'.$lang.'_details.title AS cat,
                    category_'.$lang.'_details.slug AS cat_slug
                ',
                'table' => 'products',
                'joins' => [
                    [
                        'table' => 'product_'.$lang.'_details',
                        'expresion' => 'products.id = product_'.$lang.'_details.prod_id'
                    ],
                    [
                        'table' => 'category_'.$lang.'_details',
                        'expresion' => 'products.cat_id = category_'.$lang.'_details.cat_id',
                    ]
                ],
                'conditions' => "
                    products.cat_id = $cat_id AND 
                    products.visible = 1
                "
            ]);

            $cats = Utils::storage([
                'columns' => 'id, title, slug',
                'table' => 'category_'.$lang.'_details',
                'conditions' => "id = $cat_id"
            ]);

            $pageTitle = $cats[0]['title'];
            $assets = '../../assets';
            $dir = "/public/$lang";
            $logo = $texts[$lang]['logo'];
            $catBtn = $texts[$lang]['categories'];
            $search = $texts[$lang]['search'];
            $cabinet = $texts[$lang]['cabinet'];

            $menu = '';
            $menuMobile = '';
            foreach ($pages['name'] as $k => $name) {
                $title = $pages[$lang][$k];
                $menu .= "<li class='nav-item'><a class='nav-link text-secondary px-2 py-0' href='/public/$lang/$name.html'>$title</a></li>";
                $menuMobile .= "<a class='dropdown-item' href='/public/$lang/$name.html'>$title</a>";
            }


            $details = include('details.php');
            $header = include(ROOT.'/ssr/layout/header.php');
            $footer = include(ROOT.'/ssr/layout/footer.php');

            $content = $header . $details . $footer;
            $filename = $cats[0]['slug'];
            $handle = fopen("public/$lang/category/$filename.html",'w+');
            fwrite($handle, $content);
            fclose($handle);
        }
    }
}

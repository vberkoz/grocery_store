<?php

include_once 'Product.php';
include_once ROOT.'/modules/review/Review.php';

class ProductRenderer
{
    public static function details($id, $pages, $texts)
    {
        $langs = ['ua', 'en'];
        foreach ($langs as $lang) {
            $prods = Utils::storage([
                'columns' => '
                    products.id,
                    products.cat_id,
                    products.code,
                    products.price,
                    products.visible,
                    products.vol,
                    products.vol_min,
                    product_'.$lang.'_details.title,
                    product_'.$lang.'_details.slug,
                    product_'.$lang.'_details.img,
                    product_'.$lang.'_details.desc,
                    product_'.$lang.'_details.char,
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
                    products.id = $id AND
                    products.visible = 1
                "
            ]);
            $prod = $prods[0];
            $pageTitle = $prod['title'];
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

            $desc = '';
            $descIndex = json_decode($prod['desc'], true);
            if ($descIndex) {
                foreach ($descIndex as $i) {
                    $desc .= "<p>$i</p>";
                }
            } else {
                $desc = "
                <div class='my-4'>
                    <h5 class='text-center'>Інформація відсутня</h5>
                    <p class='text-center'>Ми працюємо над вдосконаленням нашого сервісу.<br>Інформація про
                        товар незабаром з'явиться.</p>
                </div>
            ";
            }
            $prod['desc'] = $desc;

            $char = '';
            $charIndex = json_decode($prod['char'], true);
            if ($charIndex) {
                $char .= "<ul>";
                foreach ($charIndex as $k => $i) {
                    $char .= "<li><strong>$k: </strong>$i</li>";
                }
                $char .= "</ul>";
            } else {
                $char .= "
                <div class='my-4'>
                    <h5 class='text-center'>Характеристики відсутні</h5>
                    <p class='text-center'>Ми працюємо над вдосконаленням нашого сервісу.<br>Характеристики
                        товару незабаром з'являться.</p>
                </div>
            ";
            }
            $prod['char'] = $char;

            $reviews = '';
            $reviewIndex = Review::index($id);
            if ($reviewIndex) {
                foreach ($reviewIndex as $i) {
                    $name = $i['name'];
                    $text = $i['text'];
                    $reviews .= "<p><strong>$name</strong><br>$text</p>";
                }
            } else {
                $reviews = "
                <div class='my-4'>
                    <h5 class='text-center'>Відгуків ще немає</h5>
                    <p class='text-center'>Поділіться своїми думками про цей товар</p>
                </div>            
            ";
            }

            $details = include('details.php');
            $header = include(ROOT . '/ssr/layout/header.php');
            $footer = include(ROOT . '/ssr/layout/footer.php');

            $content = $header . $details . $footer;
            $filename = $prod['slug'];
            $handle = fopen("public/$lang/product/$filename.html", 'w+');
            fwrite($handle, $content);
            fclose($handle);
        }
    }
}

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
                    001_products.id,
                    001_products.cat_id,
                    001_products.code,
                    001_products.def_img,
                    001_products.price,
                    001_products.visible,
                    001_products.vol,
                    001_products.vol_min,
                    001_product_'.$lang.'_details.title,
                    001_product_'.$lang.'_details.slug,
                    001_product_'.$lang.'_details.img,
                    001_product_'.$lang.'_details.desc,
                    001_product_'.$lang.'_details.char,
                    001_product_'.$lang.'_details.unit,
                    001_category_'.$lang.'_details.title AS cat,
                    001_category_'.$lang.'_details.slug AS cat_slug
                ',
                'table' => '001_products',
                'joins' => [
                    [
                        'table' => '001_product_'.$lang.'_details',
                        'expresion' => '001_products.id = 001_product_'.$lang.'_details.prod_id'
                    ],
                    [
                        'table' => '001_category_'.$lang.'_details',
                        'expresion' => '001_products.cat_id = 001_category_'.$lang.'_details.cat_id',
                    ]
                ],
                'conditions' => "001_products.id = $id"
            ]);

            $prod = $prods[0];
            $pageTitle = $prod['title'];
            $assets = '../../assets';
            $dir = "/$lang";

            $page = 'product/'.Utils::storage([
                'columns' => 'slug',
                'table' => '001_product_'.($lang == 'ua' ? 'en' : 'ua').'_details',
                'conditions' => "prod_id = $id"
            ])[0]['slug'];

            $logo = $texts[$lang]['logo'];
            $catBtn = $texts[$lang]['categories'];
            $search = $texts[$lang]['search'];
            $cabinet = $texts[$lang]['cabinet'];

            $breadcrumbCap = $texts[$lang]['breadcrumb'];
            $codeCap = $texts[$lang]['code'];
            $priceForCap = $texts[$lang]['price_for'];
            $minOrderCap = $texts[$lang]['min_order'];
            $addToCartCap = $texts[$lang]['add_to_cart'];
            $charCap = $texts[$lang]['char'];
            $charEmptyCap = $texts[$lang]['char_empty'];
            $usefulCap = $texts[$lang]['useful'];
            $usefulEmptyCap = $texts[$lang]['useful_empty'];
            $reviewsCap = $texts[$lang]['reviews'];
            $reviewsEmptyCap = $texts[$lang]['reviews_empty'];
            $writeCap = $texts[$lang]['write'];
            $yourReviewCap = $texts[$lang]['your_review'];
            $reviewerNameCap = $texts[$lang]['reviewer_name'];
            $reviewerEmailCap = $texts[$lang]['reviewer_email'];
            $reviewerMsgCap = $texts[$lang]['reviewer_msg'];
            $cancelCap = $texts[$lang]['cancel'];
            $saveCap = $texts[$lang]['save'];

            $menu = '';
            $menuMobile = '';
            foreach ($pages['name'] as $k => $name) {
                $title = $pages[$lang][$k];
                $menu .= "<li class='nav-item'><a class='nav-link text-secondary px-2 py-0' href='/$lang/$name.html'>$title</a></li>";
                $menuMobile .= "<a class='dropdown-item' href='/$lang/$name.html'>$title</a>";
            }

            $desc = '';
            $descIndex = json_decode($prod['desc'], true);
            if ($descIndex) {
                foreach ($descIndex as $i) {
                    $desc .= "<p>$i</p>";
                }
            } else {
                $desc = $usefulEmptyCap;
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
                $char .= $charEmptyCap;
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
                $reviews = $reviewsEmptyCap;
            }

            $details = include('details.php');
            $header = include(ROOT . '/ssr/layout/header.php');
            $footer = include(ROOT . '/ssr/layout/footer.php');

            $content = $header . $details . $footer;
            $filename = $prod['slug'];
            $handle = fopen("$lang/product/$filename.html", 'w+');
            fwrite($handle, $content);
            fclose($handle);

            $file = "ssr/img/".$prod['def_img'];
            $newfile = "$lang/img/".$prod['img'];
            copy($file, $newfile);
        }
    }
}

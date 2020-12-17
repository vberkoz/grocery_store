<?php

include_once ROOT.'/modules/category/Category.php';
include_once ROOT.'/modules/category/CategoryRenderer.php';
include_once ROOT.'/modules/product/Product.php';
include_once ROOT.'/modules/product/ProductRenderer.php';

class RefreshRenderer
{
    public static function full()
    {
        $pages = [
            'name' => ['index', 'payment', 'blog', 'contact', 'about'],
            'ua' => ['Головна', 'Оплата і доставка', 'Блог', 'Контакти', 'Про нас'],
            'en' => ['Main', 'Payment and Delivery', 'Blog', 'Contacts', 'About Us']
        ];
        $texts = [
            'ua' => [
                'logo' => 'Вітамін+',
                'categories' => 'Категорії',
                'search' => 'Пошук',
                'cabinet' => 'Кабінет'
            ],
            'en' => [
                'logo' => 'Vitamin+',
                'categories' => 'Categories',
                'search' => 'Search',
                'cabinet' => 'Cabinet'
            ]
        ];

        $cats = Utils::storage([
            'columns' => '*',
            'table' => 'categories'
        ]);
        foreach ($cats as $i) {
            CategoryRenderer::details($i['id'], $pages, $texts);
        }

        $prods = Utils::storage([
            'columns' => 'id',
            'table' => 'products',
            'conditions' => 'visible = 1',
            'order' => 'id DESC'
        ]);
        foreach ($prods as $i) {
            ProductRenderer::details($i['id'], $pages, $texts);
        }

        $langs = ['ua', 'en'];
        foreach ($langs as $lang) {
            $menu = '';
            $menuMobile = '';
            foreach ($pages['name'] as $k => $name) {
                $title = $pages[$lang][$k];
                $menu .= "<li class='nav-item'><a class='nav-link text-secondary px-2 py-0' href='/public/$lang/$name.html'>$title</a></li>";
                $menuMobile .= "<a class='dropdown-item' href='/public/$lang/$name.html'>$title</a>";
            }

            self::main($lang, $menu, $menuMobile, $texts);
            self::payment($lang, $menu, $menuMobile, $texts);
            self::blog($lang, $menu, $menuMobile, $texts);
            self::contact($lang, $menu, $menuMobile, $texts);
            self::about($lang, $menu, $menuMobile, $texts);

            self::cart($lang, $menu, $menuMobile, $texts);
            self::account($lang, $menu, $menuMobile, $texts);
        }

        $r = 'Full refresh';
        return json_encode($r);
    }

    public static function account($lang, $menu, $menuMobile, $texts)
    {
        switch ($lang) {
            case 'ua': $pageTitle = 'Кабінет | Вітамін+'; break;
            case 'en': $pageTitle = 'Cabinet | Vitamin+'; break;
        }

        $logo = $texts[$lang]['logo'];
        $catBtn = $texts[$lang]['categories'];
        $search = $texts[$lang]['search'];
        $cabinet = $texts[$lang]['cabinet'];

        $assets = '../assets';
        $dir = "/public/$lang";

        $details = include('account.php');
        $header = include(ROOT.'/ssr/layout/header.php');
        $footer = include(ROOT.'/ssr/layout/footer.php');

        $content = $header . $details . $footer;
        $handle = fopen("public/$lang/account.html",'w+');
        fwrite($handle, $content);
        fclose($handle);
    }

    public static function main($lang, $menu, $menuMobile, $texts)
    {
        switch ($lang) {
            case 'ua': $pageTitle = 'Головна | Вітамін+'; break;
            case 'en': $pageTitle = 'Main | Vitamin+'; break;
        }

        $logo = $texts[$lang]['logo'];
        $catBtn = $texts[$lang]['categories'];
        $search = $texts[$lang]['search'];
        $cabinet = $texts[$lang]['cabinet'];
        $assets = '../assets';
        $dir = "/public/$lang";

        $new = Utils::storage([
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
            'conditions' => 'products.visible = 1 LIMIT 20'
        ]);

        $popular = Utils::storage([
            'columns' => '
                product_'.$lang.'_details.title,
                product_'.$lang.'_details.slug,
                product_'.$lang.'_details.img,
                product_'.$lang.'_details.unit,
                products.id,
                products.price,
                products.vol,
                products.vol_min,
                cp.num
            ',
            'table' => '(SELECT product_id AS pid, COUNT(product_id) AS num FROM cart_products GROUP BY pid) AS cp',
            'joins' => [
                [
                    'table' => 'products',
                    'expresion' => 'products.id = cp.pid'
                ],
                [
                    'table' => 'product_'.$lang.'_details',
                    'expresion' => 'product_'.$lang.'_details.prod_id = cp.pid'
                ]
            ],
            'order' => 'cp.num DESC LIMIT 20'
        ]);

        $details = include('main.php');
        $header = include(ROOT . '/ssr/layout/header.php');
        $footer = include(ROOT . '/ssr/layout/footer.php');

        $content = $header . $details . $footer;
        $handle = fopen("public/$lang/index.html", 'w+');
        fwrite($handle, $content);
        fclose($handle);
    }

    public static function payment($lang, $menu, $menuMobile, $texts)
    {
        switch ($lang) {
            case 'ua': $pageTitle = 'Оплата і Доставка | Вітамін+'; break;
            case 'en': $pageTitle = 'Payment and Delivery | Vitamin+'; break;
        }

        $logo = $texts[$lang]['logo'];
        $catBtn = $texts[$lang]['categories'];
        $search = $texts[$lang]['search'];
        $cabinet = $texts[$lang]['cabinet'];
        $assets = '../assets';
        $dir = "/public/$lang";

        $details = include('payment.php');
        $header = include(ROOT.'/ssr/layout/header.php');
        $footer = include(ROOT.'/ssr/layout/footer.php');

        $content = $header . $details . $footer;
        $handle = fopen("public/$lang/payment.html",'w+');
        fwrite($handle, $content);
        fclose($handle);
    }

    public static function blog($lang, $menu, $menuMobile, $texts)
    {
        switch ($lang) {
            case 'ua': $pageTitle = 'Блог | Вітамін+'; break;
            case 'en': $pageTitle = 'Blog | Vitamin+'; break;
        }

        $logo = $texts[$lang]['logo'];
        $catBtn = $texts[$lang]['categories'];
        $search = $texts[$lang]['search'];
        $cabinet = $texts[$lang]['cabinet'];
        $assets = '../assets';
        $dir = "/public/$lang";

        $details = include('blog.php');
        $header = include(ROOT.'/ssr/layout/header.php');
        $footer = include(ROOT.'/ssr/layout/footer.php');

        $content = $header . $details . $footer;
        $handle = fopen("public/$lang/blog.html",'w+');
        fwrite($handle, $content);
        fclose($handle);
    }

    public static function contact($lang, $menu, $menuMobile, $texts)
    {
        switch ($lang) {
            case 'ua': $pageTitle = 'Контакти | Вітамін+'; break;
            case 'en': $pageTitle = 'Contacts | Vitamin+'; break;
        }

        $logo = $texts[$lang]['logo'];
        $catBtn = $texts[$lang]['categories'];
        $search = $texts[$lang]['search'];
        $cabinet = $texts[$lang]['cabinet'];
        $assets = '../assets';
        $dir = "/public/$lang";

        $details = include('contact.php');
        $header = include(ROOT.'/ssr/layout/header.php');
        $footer = include(ROOT.'/ssr/layout/footer.php');

        $content = $header . $details . $footer;
        $handle = fopen("public/$lang/contact.html",'w+');
        fwrite($handle, $content);
        fclose($handle);
    }

    public static function about($lang, $menu, $menuMobile, $texts)
    {
        switch ($lang) {
            case 'ua': $pageTitle = 'Про нас | Вітамін+'; break;
            case 'en': $pageTitle = 'About Us | Vitamin+'; break;
        }

        $logo = $texts[$lang]['logo'];
        $catBtn = $texts[$lang]['categories'];
        $search = $texts[$lang]['search'];
        $cabinet = $texts[$lang]['cabinet'];
        $assets = '../assets';
        $dir = "/public/$lang";

        $details = include('about.php');
        $header = include(ROOT.'/ssr/layout/header.php');
        $footer = include(ROOT.'/ssr/layout/footer.php');

        $content = $header . $details . $footer;
        $handle = fopen("public/$lang/about.html",'w+');
        fwrite($handle, $content);
        fclose($handle);
    }

    public static function cart($lang, $menu, $menuMobile, $texts)
    {
        switch ($lang) {
            case 'ua': $pageTitle = 'Кошик | Вітамін+'; break;
            case 'en': $pageTitle = 'Cart | Vitamin+'; break;
        }

        $logo = $texts[$lang]['logo'];
        $catBtn = $texts[$lang]['categories'];
        $search = $texts[$lang]['search'];
        $cabinet = $texts[$lang]['cabinet'];
        $assets = '../assets';
        $dir = "/public/$lang";

        $details = include('cart.php');
        $header = include(ROOT.'/ssr/layout/header.php');
        $footer = include(ROOT.'/ssr/layout/footer.php');

        $content = $header . $details . $footer;
        $handle = fopen("public/$lang/cart.html",'w+');
        fwrite($handle, $content);
        fclose($handle);
    }
}

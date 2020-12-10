<?php

include_once ROOT.'/modules/category/Category.php';
include_once ROOT.'/modules/category/CategoryRenderer.php';
include_once ROOT.'/modules/product/Product.php';
include_once ROOT.'/modules/product/ProductRenderer.php';

class RefreshRenderer
{
    public static function full()
    {
        $categories = Category::selectAll();
        foreach ($categories as $i) {
            CategoryRenderer::details($i['id']);
        }

        $products = Product::selectAll();
        foreach ($products as $i) {
            ProductRenderer::details($i['id']);
        }

        self::main();
        self::payment();
        self::blog();
        self::contact();
        self::about();

        self::cart();

        return json_encode('Full refresh');
    }

    public static function main()
    {
        $pageTitle = 'Головна';
        $assets = 'assets';
        $directory = '/public';

        $details = include('main.php');
        $header = include(ROOT.'/ssr/layout/header.php');
        $footer = include(ROOT.'/ssr/layout/footer.php');

        $content = $header . $details . $footer;
        $handle = fopen("public/index.html",'w+');
        fwrite($handle, $content);
        fclose($handle);
    }

    public static function payment()
    {
        $pageTitle = 'Оплата і доставка';
        $assets = 'assets';
        $directory = '/public';

        $details = include('payment.php');
        $header = include(ROOT.'/ssr/layout/header.php');
        $footer = include(ROOT.'/ssr/layout/footer.php');

        $content = $header . $details . $footer;
        $handle = fopen("public/payment.html",'w+');
        fwrite($handle, $content);
        fclose($handle);
    }

    public static function blog()
    {
        $pageTitle = 'Блог';
        $assets = 'assets';
        $directory = '/public';

        $details = include('blog.php');
        $header = include(ROOT.'/ssr/layout/header.php');
        $footer = include(ROOT.'/ssr/layout/footer.php');

        $content = $header . $details . $footer;
        $handle = fopen("public/blog.html",'w+');
        fwrite($handle, $content);
        fclose($handle);
    }

    public static function contact()
    {
        $pageTitle = 'Контакти';
        $assets = 'assets';
        $directory = '/public';

        $details = include('contact.php');
        $header = include(ROOT.'/ssr/layout/header.php');
        $footer = include(ROOT.'/ssr/layout/footer.php');

        $content = $header . $details . $footer;
        $handle = fopen("public/contact.html",'w+');
        fwrite($handle, $content);
        fclose($handle);
    }

    public static function about()
    {
        $pageTitle = 'Про нас';
        $assets = 'assets';
        $directory = '/public';

        $details = include('about.php');
        $header = include(ROOT.'/ssr/layout/header.php');
        $footer = include(ROOT.'/ssr/layout/footer.php');

        $content = $header . $details . $footer;
        $handle = fopen("public/about.html",'w+');
        fwrite($handle, $content);
        fclose($handle);
    }

    public static function cart()
    {
        $pageTitle = 'Кошик | Вітамін+';
        $assets = 'assets';
        $directory = '/public';

        $details = include('cart.php');
        $header = include(ROOT.'/ssr/layout/header.php');
        $footer = include(ROOT.'/ssr/layout/footer.php');

        $content = $header . $details . $footer;
        $handle = fopen("public/cart.html",'w+');
        fwrite($handle, $content);
        fclose($handle);
    }
}

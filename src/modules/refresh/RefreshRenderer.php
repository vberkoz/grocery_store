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
                'cabinet' => 'Кабінет',

                'new' => 'Нові',
                'popular' => 'Популярні',

                'goods' => 'Товари',
                'discount' => 'Знижка',
                'total' => 'Всього',
                'order' => 'Замовити',

                'your_order' => 'Ваше замовлення',
                'warn' => 'Звертаємо Вашу увагу на те, що вартість замовлення, розрахована на сайті, являється приблизною і може відрізнятися від вартості при оплаті.',
                'info' => 'Сьогодні будуть доставлені замовлення які були оформлені до 4-ї години ранку. Замовлення оформлені після 4-ї години ранку будуть доставлені завтра.',
                'help' => "Щоб оформити замовлення заповніть обов'язкові поля 'Ваше ім'я' та 'Номер телефону' і наш працівник незабаром зв'яжеться з Вами. Також Ви можете вказати адресу доставки та повідомлення для пакувальника.",
                'name' => "Ваше ім`я",
                'phone' => 'Номер телефону',
                'address' => 'Адреса',
                'msg' => 'Повідомлення для пакувальника',
                'm2' => 'Мінімум 2 символи',
                'm10' => 'Мінімум 10 цифр',
                'privacy' => 'Ми не передаємо особисту інформацію наших клієнтів іншим сторонам.',
                'make' => 'Оформити замовлення',

                'breadcrumb' => 'Головна',
                'code' => 'Код товару',
                'price_for' => 'Ціна за',
                'min_order' => 'Мін. замовлення',
                'add_to_cart' => 'Покласти в кошик',
                'char' => 'Характеристики',
                'char_empty' => "<div class='my-4'><h5 class='text-center'>Характеристики відсутні</h5><p class='text-center'>Ми працюємо над вдосконаленням нашого сервісу.<br>Характеристики товару незабаром з'являться.</p></div>",
                'useful' => 'Корисна інформація',
                'useful_empty' => "<div class='my-4'><h5 class='text-center'>Інформація відсутня</h5><p class='text-center'>Ми працюємо над вдосконаленням нашого сервісу.<br>Інформація про товар незабаром з'явиться.</p></div>",
                'reviews' => 'Відгуки',
                'reviews_empty' => "<div class='my-4'><h5 class='text-center'>Відгуків ще немає</h5><p class='text-center'>Поділіться своїми думками про цей товар</p></div>",
                'write' => 'Написати',
                'your_review' => 'Ваш відгук',
                'reviewer_name' => "Ім`я",
                'reviewer_email' => 'Електронна пошта',
                'reviewer_msg' => 'Відгук',
                'cancel' => 'Відміна',
                'save' => 'Зберегти',

                'login_to_cabinet' => 'Увійти в кабінет',
                'cabinet_email' => 'Електронна пошта',
                'invalid_email' => 'Невірний формат електронної пошти',
                'password' => 'Пароль',
                'change_password' => 'Змінити',
                'invalid_password' => 'Пароль має бути не менше 6-ти символів',
                'login' => 'Зайти',
                'first_time' => 'Вперше тут?',
                'register' => 'Зареєструйся',
            ],
            'en' => [
                'logo' => 'Vitamin+',
                'categories' => 'Categories',
                'search' => 'Search',
                'cabinet' => 'Cabinet',

                'new' => 'New',
                'popular' => 'Popular',

                'goods' => 'Goods',
                'discount' => 'Discount',
                'total' => 'Total',
                'order' => 'Order',

                'your_order' => 'Your order',
                'warn' => 'Please note that the cost of the order, calculated on the site, is approximate and may differ from the cost of payment.',
                'info' => "Orders that were placed before 4 o'clock in the morning will be delivered today. Orders placed after 4 o'clock in the morning will be delivered tomorrow.",
                'help' => "To place an order, fill in the required fields 'Your name' and 'Phone number' and our employee will contact you shortly. You can also specify the delivery address and message for the packer.",
                'name' => 'Your name',
                'phone' => 'Phone number',
                'address' => 'Address',
                'msg' => 'Message for the packer',
                'm2' => 'At least 2 characters',
                'm10' => 'At least 10 digits',
                'privacy' => 'We do not pass personal information of our customers to other parties.',
                'make' => 'Finish',

                'breadcrumb' => 'Main',
                'code' => 'Product code',
                'price_for' => 'Price for',
                'min_order' => 'Min. order',
                'add_to_cart' => 'Add to Cart',
                'char' => 'Characteristics',
                'char_empty' => "<div class='my-4'><h5 class='text-center'>No characteristics</h5><p class='text-center'>We are working to improve our service.<br>Product characteristics will appear soon.</p></div>",
                'useful' => 'Useful Information',
                'useful_empty' => "<div class='my-4'><h5 class='text-center'>No information available</h5><p class='text-center'>We are working to improve our service.<br>Product information will appear soon.</p></div>",
                'reviews' => 'Reviews',
                'reviews_empty' => "<div class='my-4'><h5 class='text-center'>There are no reviews yet</h5><p class='text-center'>Share your thoughts on this product</p></div>",
                'write' => 'Write',
                'your_review' => 'Your review',
                'reviewer_name' => 'Name',
                'reviewer_email' => 'Email',
                'reviewer_msg' => 'Review',
                'cancel' => 'Cancel',
                'save' => 'Save',

                'login_to_cabinet' => 'Login to cabinet',
                'cabinet_email' => 'Email',
                'invalid_email' => 'Invalid email format',
                'password' => 'Password',
                'change_password' => 'Change',
                'invalid_password' => 'Password must be at least 6 characters long',
                'login' => 'Login',
                'first_time' => 'First time here?',
                'register' => 'Register',
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
            self::checkout($lang, $menu, $menuMobile, $texts);
            self::cabinet($lang, $menu, $menuMobile, $texts);
        }

        $r = 'Full refresh';
        return json_encode($r);
    }

    public static function cabinet($lang, $menu, $menuMobile, $texts)
    {
        switch ($lang) {
            case 'ua': $pageTitle = 'Кабінет | Вітамін+'; break;
            case 'en': $pageTitle = 'Cabinet | Vitamin+'; break;
        }

        $logo = $texts[$lang]['logo'];
        $catBtn = $texts[$lang]['categories'];
        $search = $texts[$lang]['search'];
        $cabinet = $texts[$lang]['cabinet'];

        $loginToCabinetCap = $texts[$lang]['login_to_cabinet'];
        $cabinetEmailCap = $texts[$lang]['cabinet_email'];
        $invalidEmailCap = $texts[$lang]['invalid_email'];
        $passwordCap = $texts[$lang]['password'];
        $changePasswordCap = $texts[$lang]['change_password'];
        $invalidPasswordCap = $texts[$lang]['invalid_password'];
        $loginCap = $texts[$lang]['login'];
        $firstTimeCap = $texts[$lang]['first_time'];
        $registerCap = $texts[$lang]['register'];

        $assets = '../assets';
        $dir = "/public/$lang";
        $page = 'cabinet';

        $details = include('cabinet.php');
        $header = include(ROOT.'/ssr/layout/header.php');
        $footer = include(ROOT.'/ssr/layout/footer.php');

        $content = $header . $details . $footer;
        $handle = fopen("public/$lang/cabinet.html",'w+');
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
        $newCap = $texts[$lang]['new'];
        $popularCap = $texts[$lang]['popular'];

        $assets = '../assets';
        $dir = "/public/$lang";
        $page = 'index';

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
        $page = 'payment';

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
        $page = 'blog';

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
        $page = 'contact';

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
        $page = 'about';

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

        $goodsCap = $texts[$lang]['goods'];
        $discountCap = $texts[$lang]['discount'];
        $totalCap = $texts[$lang]['total'];
        $orderCap = $texts[$lang]['order'];

        $assets = '../assets';
        $dir = "/public/$lang";
        $page = 'cart';

        $details = include('cart.php');
        $header = include(ROOT.'/ssr/layout/header.php');
        $footer = include(ROOT.'/ssr/layout/footer.php');

        $content = $header . $details . $footer;
        $handle = fopen("public/$lang/cart.html",'w+');
        fwrite($handle, $content);
        fclose($handle);
    }

    public static function checkout($lang, $menu, $menuMobile, $texts)
    {
        switch ($lang) {
            case 'ua': $pageTitle = 'Перевірка | Вітамін+'; break;
            case 'en': $pageTitle = 'Checkout | Vitamin+'; break;
        }

        $logo = $texts[$lang]['logo'];
        $catBtn = $texts[$lang]['categories'];
        $search = $texts[$lang]['search'];
        $cabinet = $texts[$lang]['cabinet'];

        $yourOrderCap = $texts[$lang]['your_order'];
        $warnCap = $texts[$lang]['warn'];
        $infoCap = $texts[$lang]['info'];
        $helpCap = $texts[$lang]['help'];
        $nameCap = $texts[$lang]['name'];
        $phoneCap = $texts[$lang]['phone'];
        $addressCap = $texts[$lang]['address'];
        $msgCap = $texts[$lang]['msg'];
        $m2Cap = $texts[$lang]['m2'];
        $m10Cap = $texts[$lang]['m10'];
        $privacyCap = $texts[$lang]['privacy'];
        $makeCap = $texts[$lang]['make'];

        $assets = '../assets';
        $dir = "/public/$lang";
        $page = 'checkout';

        $details = include('checkout.php');
        $header = include(ROOT.'/ssr/layout/header.php');
        $footer = include(ROOT.'/ssr/layout/footer.php');

        $content = $header . $details . $footer;
        $handle = fopen("public/$lang/checkout.html",'w+');
        fwrite($handle, $content);
        fclose($handle);
    }
}

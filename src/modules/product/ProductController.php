<?php

include_once 'Product.php';
include_once 'ProductRenderer.php';
include_once ROOT.'/modules/category/Category.php';
include_once ROOT.'/modules/category/CategoryRenderer.php';

class ProductController
{
    public function index(): bool
    {
        echo json_encode(Product::selectAll());
        return true;
    }

    public function show(): bool
    {
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);
        $product = Product::selectOne($decoded);
        $r = [
            'product' => $product,
            'categories' => Category::selectAll()
        ];
        echo json_encode($r);
        return true;
    }

    public function update(): bool
    {
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);
        Product::update($decoded);
        $ifp = fopen($_SERVER['DOCUMENT_ROOT'] . "/ssr/img/{$decoded['code']}.jpg", 'wb');
        fwrite($ifp, base64_decode($decoded['img']));
        fclose($ifp);
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
            ],
            'en' => [
                'logo' => 'Vitamin+',
                'categories' => 'Categories',
                'search' => 'Search',
                'cabinet' => 'Cabinet',

                'new' => 'New',
                'popular' => 'Popular',

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

                'change_password' => 'Change',
                'invalid_password' => 'Password must be at least 6 characters long',
                'login' => 'Login',
            ]
        ];
        ProductRenderer::details($decoded['id'], $pages, $texts);
        CategoryRenderer::details($decoded['cat_id'], $pages, $texts);
        return true;
    }

    public function store(): bool
    {
        $product = Product::insert();
        echo json_encode($product);
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
            ],
            'en' => [
                'logo' => 'Vitamin+',
                'categories' => 'Categories',
                'search' => 'Search',
                'cabinet' => 'Cabinet',

                'new' => 'New',
                'popular' => 'Popular',

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

                'change_password' => 'Change',
                'invalid_password' => 'Password must be at least 6 characters long',
                'login' => 'Login',
            ]
        ];
        ProductRenderer::details($product['id'], $pages, $texts);
        return true;
    }

    public function destroy(): bool
    {
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);
        Product::deleteSelected(implode(', ', $decoded));
        return true;
    }
}

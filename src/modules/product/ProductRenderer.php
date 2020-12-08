<?php

include_once 'Product.php';
include_once ROOT.'/modules/review/Review.php';

class ProductRenderer
{
    public static function details($id)
    {
        $product = Product::selectOne($id);
        $pageTitle = $product['title'];
        $assets = '../assets';
        $directory = '/public';

        $description = '';
        $descriptionIndex = json_decode($product['description'], true);
        if ($descriptionIndex) {
            foreach ($descriptionIndex as $value) {
                $description .= "<p>$value</p>";
            }
        } else {
            $description = "
                <div class='my-4'>
                    <h5 class='text-center'>Інформація відсутня</h5>
                    <p class='text-center'>Ми працюємо над вдосконаленням нашого сервісу.<br>Інформація про
                        товар незабаром з'явиться.</p>
                </div>
            ";
        }
        $product['description'] = $description;

        $characteristics = '';
        $characteristicsIndex = json_decode($product['characteristics'], true);
        if ($characteristicsIndex) {
            $characteristics .= "<ul>";
            foreach ($characteristicsIndex as $key => $value) {
                $characteristics .= "<li><strong>$key: </strong>$value</li>";
            }
            $characteristics .= "</ul>";
        } else {
            $characteristics .= "
                <div class='my-4'>
                    <h5 class='text-center'>Характеристики відсутні</h5>
                    <p class='text-center'>Ми працюємо над вдосконаленням нашого сервісу.<br>Характеристики
                        товару незабаром з'являться.</p>
                </div>
            ";
        }
        $product['characteristics'] = $characteristics;

        $reviews = '';
        $reviewIndex = Review::index($id);
        if ($reviewIndex) {
            foreach ($reviewIndex as $item) {
                $name = $item['name'];
                $text = $item['text'];
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
        $header = include(ROOT.'/ssr/layout/header.php');
        $footer = include(ROOT.'/ssr/layout/footer.php');

        $content = $header . $details . $footer;
        $filename = $product['slug'];
        $handle = fopen("public/product/$filename.html",'w+');
        fwrite($handle, $content);
        fclose($handle);
    }
}

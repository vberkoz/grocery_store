<?php


class CartRenderer
{
    static public function mailTemplate($data)
    {
        $items = '';
        $fmt = numfmt_create( 'uk_UA', NumberFormatter::CURRENCY );
        $hash = $data['hash'];
        $cartPrice = numfmt_format_currency($fmt, $data['price'], "UAH");
        $cartDiscount = numfmt_format_currency($fmt, $data['discount'], "UAH");
        $cartTotal = $data['price'] - $data['discount'];
        $cartTotal = numfmt_format_currency($fmt, $cartTotal, "UAH");
        $name = $data['name'];
        $phone = $data['phone'];
        $address = $data['address'];
        $message = $data['message'];
        foreach ($data['items'] as $i) {
            $image = $i['image'];
            $title = $i['title'];
            $volume = $i['volume'];
            $quantity = $i['quantity'];
            $unit = $i['unit'];
            $total = numfmt_format_currency($fmt, $i['total'], "UAH");
            $price = numfmt_format_currency($fmt, $i['price'], "UAH");
            $items .= "
                <div class='col-12 col-md-4 mb-2'>
                    <div class='row'>
                        <div class='col-4'>
                            <img src='http://localhost:8080/public/assets/images/$image' alt='$image' class='img-fluid'>
                        </div>
                        <div class='col-8'>
                            <p class='title mb-0'>$title</p>
                            <small>
                                <div class='text-muted'>
                                    <span class='py-2'>$volume $unit</span>
                                    <span class='p-2'>$price</span>
                                </div>
                                <div class='text-dark'>
                                    <span class='py-2'>$quantity $unit</span>
                                    <span class='p-2'>$total</span>
                                </div>
                            </small>
                        </div>
                    </div>
                </div>
            ";
        }
        $content = include('mail_template.php');
//        $handle = fopen("public/mail_template.html",'w+');
//        fwrite($handle, $content);
//        fclose($handle);

        return $content;
    }
}

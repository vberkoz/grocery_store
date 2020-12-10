<?php

$category_slug = $product['category_slug'];
$category_title = $product['category'];
$title = $product['title'];
$image = $product['image'];
$code = $product['code'];
$volume = $product['volume'];
$unit = $product['unit'];
$volume_min = $product['volume_min'];
$id = $product['id'];

$fmt = numfmt_create( 'uk_UA', NumberFormatter::CURRENCY );
$price = numfmt_format_currency($fmt, $product['price'], "UAH");

return $details = "
<main role='main' class='content container-fluid px-4' style='margin-top: 120px;'>
<div class='row'>
<aside class='container-fluid'>
    <div class='row' id='products'>
        <div class='col-md-12 col-xl-8 offset-xl-2 p-1'>
            <nav class='card' aria-label='breadcrumb'>
                <ol class='breadcrumb m-0' style='background-color: rgba(255, 255, 128, .0)'>
                    <li class='breadcrumb-item'><a href='/'>Головна</a></li>
                    <li class='breadcrumb-item'>
                        <a href='$directory/category/$category_slug.html'>$category_title</a>
                    </li>
                    <li class='breadcrumb-item active' aria-current='page'>$title</li>
                </ol>
            </nav>
        </div>

        <div class='col-md-6 col-xl-4 offset-xl-2 p-1'>
            <div class='card h-100'>
                <div class='card-body d-flex align-items-center'>
                    <img class='align-middle mx-auto d-block img-fluid'
                         src='$assets/images/$image' alt='$title'>
                </div>
            </div>
        </div>

        <div class='col-md-6 col-xl-4 p-1'>
            <div class='card'>
                <div class='card-body'>
                    <p class='text-muted'><small><strong>Код товару: $code</strong></small></p>
                    <h1 class='card-title'><strong>$title</strong></h1>
                    <p class='text-muted'>
                        <small>Ціна за $volume $unit</small><br>
                        <small>Мін. замовлення $volume_min $unit</small>
                    </p>

                    <div>
                        <div class='h1'>$price</div>
                        <div class='d-flex flex-column justify-content-between'>
                            <a href='#' class='add-to-bag-first btn btn-outline-primary'
                               data-id='$id' data-unit='$unit'>
                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 426.667 426.667' height='1em' fill='currentColor'>
                                    <path d='M128,341.333c-23.573,0-42.453,19.093-42.453,42.667s18.88,42.667,42.453,42.667c23.573,0,42.667-19.093,42.667-42.667     S151.573,341.333,128,341.333z'/>
                                    <path d='M151.467,234.667H310.4c16,0,29.973-8.853,37.333-21.973L424,74.24c1.707-2.987,2.667-6.507,2.667-10.24     c0-11.84-9.6-21.333-21.333-21.333H89.92L69.653,0H0v42.667h42.667L119.36,204.48l-28.8,52.267     c-3.307,6.187-5.227,13.12-5.227,20.587C85.333,300.907,104.427,320,128,320h256v-42.667H137.067     c-2.987,0-5.333-2.347-5.333-5.333c0-0.96,0.213-1.813,0.64-2.56L151.467,234.667z'/>
                                    <path d='M341.333,341.333c-23.573,0-42.453,19.093-42.453,42.667s18.88,42.667,42.453,42.667     C364.907,426.667,384,407.573,384,384S364.907,341.333,341.333,341.333z'/>
                                </svg> Покласти в кошик
                            </a>

                            <div class='input-group d-none'>
                                <div class='input-group-prepend'>
                                    <button type='button' class='btn btn-outline-primary remove-from-bag'
                                        data-id='$id' data-volume_min='$volume_min' data-unit='$unit'>
                                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 459 459' height='0.6em'
                                             fill='currentColor' class='align-middle'>
                                            <path d='M459.313,229.648c0,22.201-17.992,40.199-40.205,40.199H40.181c-11.094,0-21.14-4.498-28.416-11.774   C4.495,250.808,0,240.76,0,229.66c-0.006-22.204,17.992-40.199,40.202-40.193h378.936   C441.333,189.472,459.308,207.456,459.313,229.648z'/>
                                        </svg>
                                    </button>
                                </div>

                                <input type='text' class='form-control text-center input-float' data-id='$id' data-unit='$unit'>

                                <div class='input-group-append'>
                                    <button type='button' class='btn btn-outline-primary add-to-bag-second'
                                        data-id='$id' data-volume_min='$volume_min' data-unit='$unit'>
                                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 448' height='0.8em'
                                            fill='currentColor' class='align-middle'>
                                            <path d='m408 184h-136c-4.417969 0-8-3.582031-8-8v-136c0-22.089844-17.910156-40-40-40s-40 17.910156-40 40v136c0 4.417969-3.582031 8-8 8h-136c-22.089844 0-40 17.910156-40 40s17.910156 40 40 40h136c4.417969 0 8 3.582031 8 8v136c0 22.089844 17.910156 40 40 40s40-17.910156 40-40v-136c0-4.417969 3.582031-8 8-8h136c22.089844 0 40-17.910156 40-40s-17.910156-40-40-40zm0 0'/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class='card mt-2'>
                <div class='card-body'>
                    <h4 class='card-title'>Характеристики</h4>
                    <hr>$characteristics
                </div>
            </div>
        </div>

        <div class='col-md-6 col-xl-4 offset-xl-2 p-1'>
            <div class='card'>
                <div class='card-body'>
                    <h4 class='card-title'>Корисна інформація</h4>
                    <hr>$description
                </div>
            </div>
        </div>

        <div class='col-md-6 col-xl-4 p-1'>
            <div class='card'>
                <div class='card-body'>
                    <div class='d-flex justify-content-between'>
                        <h4 class='card-title mb-0'>Відгуки</h4>
                        <button type='button' class='btn btn-sm btn-link' data-toggle='modal' data-target='#productReview'>Написати</button>
                        <div class='modal fade' id='productReview' tabindex='-1' role='dialog' aria-hidden='true'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title'>Ваш відгук</h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    <div class='modal-body'>
                                        <form>
                                            <input type='text' id='product_id' class='d-none' value='$id'>
                                            <div class='form-group'>
                                                <label for='reviewer_name'>Ім'я</label>
                                                <input type='text' class='form-control' id='reviewer_name'
                                                       placeholder='Ваше ім`я'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='reviewer_email'>Електронна пошта</label>
                                                <input type='email' class='form-control' id='reviewer_email'
                                                       placeholder='name@example.com'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='reviewer_text'>Відгук</label>
                                                <textarea class='form-control' id='reviewer_text' rows='3'
                                                          placeholder='Ваш відгук'></textarea>
                                            </div>
                                        </form>
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Відміна
                                        </button>
                                        <button type='button' class='btn btn-primary' data-dismiss='modal'
                                                onclick='saveReview()'>Зберегти
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div id='reviews'>$reviews</div>
                </div>
            </div>
        </div>
    </div>
</aside>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js'></script>
<script src='https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js'></script>
<script src='//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js'></script>
<script src='$assets/js/main.js'></script>
<script src='$assets/js/categories.js'></script>
<script src='$assets/js/search.js'></script>
<script src='$assets/js/card.js'></script>
";

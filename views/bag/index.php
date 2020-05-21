<?php include_once ROOT . '/views/layouts/header.php'?>

<?php if ($bag): ?>
    <div class="col-md-9 mb-3">
        <div class="card">
            <div class="card-body">
                <table class="table-responsive">
                    <thead>
                        <tr class="small text-uppercase text-muted">
                            <th scope="col" class="px-3">Продукт</th>
                            <th scope="col" class="px-3" width="150">Кількість</th>
                            <th scope="col" class="px-3" width="150">Ціна</th>
                            <th scope="col" class="text-right d-none d-md-block px-3" width="170"> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr class="bag-item" bag-item-id="<?php echo $product['id']; ?>">
                                <td class="p-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="/product/<?php echo $product['id']; ?>/<?php echo $product['category_id']; ?>">
                                                <img class="img-fluid border"
                                                     src="/template/images/<?php echo $product['image']; ?>"
                                                     alt="<?php echo $product['title']; ?>">
                                            </a>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="m-0"><?php echo $product['title']; ?></p>
                                            <small class="text-muted"><?php echo $product['product_id']; ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-primary bag-minus" type="button" data-id="<?php echo $product['id']; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 459 459" height="0.6em" fill="currentColor" class="align-middle">
                                                    <path d="M459.313,229.648c0,22.201-17.992,40.199-40.205,40.199H40.181c-11.094,0-21.14-4.498-28.416-11.774   C4.495,250.808,0,240.76,0,229.66c-0.006-22.204,17.992-40.199,40.202-40.193h378.936   C441.333,189.472,459.308,207.456,459.313,229.648z"/>
                                                </svg>
                                            </button>
                                        </div>

                                        <input type="text" class="form-control text-center bag-change" data-id="<?php echo $product['id']; ?>" value="<?php echo $bag[$product['id']]; ?>">

                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary bag-plus" type="button" data-id="<?php echo $product['id']; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 448" height="0.8em" fill="currentColor" class="align-middle">
                                                    <path d="m408 184h-136c-4.417969 0-8-3.582031-8-8v-136c0-22.089844-17.910156-40-40-40s-40 17.910156-40 40v136c0 4.417969-3.582031 8-8 8h-136c-22.089844 0-40 17.910156-40 40s17.910156 40 40 40h136c4.417969 0 8 3.582031 8 8v136c0 22.089844 17.910156 40 40 40s40-17.910156 40-40v-136c0-4.417969 3.582031-8 8-8h136c22.089844 0 40-17.910156 40-40s-17.910156-40-40-40zm0 0"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3">
                                    <p>
                                        <span class="item-total"></span>
<!--                                        <span class="item-total1">--><?php //echo numfmt_format_currency($fmt, $product['price'] * $bag[$product['id']], "UAH"); ?><!--</span>-->
                                        <br>
                                        <small class="text-muted item-price"></small>
<!--                                        <small class="text-muted">--><?php //echo numfmt_format_currency($fmt, $product['price'], "UAH"); ?><!--</small>-->
                                    </p>
                                </td>
                                <td class="p-3">
<!--                                    <button type="button" class="btn btn-outline-secondary">-->
<!--                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 456" height="1.3em" fill="currentColor" class="align-middle pb-1">-->
<!--                                            <path d="m471.382812 44.578125c-26.503906-28.746094-62.871093-44.578125-102.410156-44.578125-29.554687 0-56.621094 9.34375-80.449218 27.769531-12.023438 9.300781-22.917969 20.679688-32.523438 33.960938-9.601562-13.277344-20.5-24.660157-32.527344-33.960938-23.824218-18.425781-50.890625-27.769531-80.445312-27.769531-39.539063 0-75.910156 15.832031-102.414063 44.578125-26.1875 28.410156-40.613281 67.222656-40.613281 109.292969 0 43.300781 16.136719 82.9375 50.78125 124.742187 30.992188 37.394531 75.535156 75.355469 127.117188 119.3125 17.613281 15.011719 37.578124 32.027344 58.308593 50.152344 5.476563 4.796875 12.503907 7.4375 19.792969 7.4375 7.285156 0 14.316406-2.640625 19.785156-7.429687 20.730469-18.128907 40.707032-35.152344 58.328125-50.171876 51.574219-43.949218 96.117188-81.90625 127.109375-119.304687 34.644532-41.800781 50.777344-81.4375 50.777344-124.742187 0-42.066407-14.425781-80.878907-40.617188-109.289063zm0 0"/>-->
<!--                                        </svg>-->
<!--                                    </button>-->
                                    <a class="btn btn-outline-danger" href="/bag/remove/<?php echo $product['id']; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="1.4em" fill="currentColor" class="align-middle pb-1">
                                            <path d="M425.298,51.358h-91.455V16.696c0-9.22-7.475-16.696-16.696-16.696H194.854c-9.22,0-16.696,7.475-16.696,16.696v34.662    H86.703c-9.22,0-16.696,7.475-16.696,16.696v51.357c0,9.22,7.475,16.696,16.696,16.696h338.593c9.22,0,16.696-7.475,16.696-16.696    V68.054C441.993,58.832,434.518,51.358,425.298,51.358z M300.45,51.358h-88.9V33.391h88.9V51.358z"/>
                                            <path d="M93.192,169.497l13.844,326.516c0.378,8.937,7.735,15.988,16.68,15.988h264.568c8.945,0,16.302-7.051,16.68-15.989    l13.843-326.515H93.192z M205.53,444.105c0,9.22-7.475,16.696-16.696,16.696c-9.22,0-16.696-7.475-16.696-16.696V237.391    c0-9.22,7.475-16.696,16.696-16.696c9.22,0,16.696,7.475,16.696,16.696V444.105z M272.693,444.105    c0,9.22-7.475,16.696-16.696,16.696s-16.696-7.475-16.696-16.696V237.391c0-9.22,7.475-16.696,16.696-16.696    s16.696,7.475,16.696,16.696V444.105z M339.856,444.105c0,9.22-7.475,16.696-16.696,16.696s-16.696-7.475-16.696-16.696V237.391    c0-9.22,7.475-16.696,16.696-16.696s16.696,7.475,16.696,16.696V444.105z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between m-0">
                    <p class="m-0">Товари:</p>
                    <p class="m-0 bag-items-price"></p>
<!--                    <p class="m-0">--><?php //echo numfmt_format_currency($fmt, $totalPrice, "UAH"); ?><!--</p>-->
                </div>
                <div class="d-flex justify-content-between m-0">
                    <p class="m-0">Знижка:</p>
                    <p class="m-0 text-danger"><?php echo '- ' . numfmt_format_currency($fmt, 0, "UAH"); ?></p>
                </div>
                <div class="d-flex justify-content-between m-0">
                    <p class="m-0">Всього:</p>
                    <p class="m-0"><b class="bag-total"></b></p>
<!--                    <p class="m-0"><b>--><?php //echo numfmt_format_currency($fmt, $totalPrice, "UAH"); ?><!--</b></p>-->
                </div>
                <hr>
                <a href="/bag/checkout" class="btn btn-primary btn-block">Замовити</a>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="d-flex justify-content-center w-100">
        <div class="alert alert-info" role="alert">Кошик порожній</div>
    </div>
<?php endif; ?>

<?php include_once ROOT . '/views/layouts/footer.php'?>
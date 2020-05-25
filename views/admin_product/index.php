<?php include_once ROOT . '/views/layouts/admin_header.php'?>

    <div class="card mb-3 w-100">
        <div class="card-body">
            <a href="/admin/product/create" class="btn btn-primary mb-3">Додати товар</a>
            <?php if ($products): ?>
            <div class="row px-3">
                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">#</th>
                        <th scope="col">Фото</th>
                        <th scope="col">Назва</th>
                        <th scope="col">Категорія</th>
                        <th scope="col">Код</th>
                        <th scope="col">Наявність</th>
                        <th scope="col">Показувати</th>
                        <th scope="col">Об'єм</th>
                        <th scope="col">Одиниці</th>
                        <th scope="col" class="text-right">Ціна</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($products as $key => $product): ?>
                        <tr class="product-record">
                            <td class="align-middle">
                                <a class="btn btn-outline-secondary btn-sm border-0" href="/admin/product/update/<?php echo $product['id']; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 528 528" height="1.4em" fill="currentColor" class="align-middle pb-1">
                                        <path d="M328.883,89.125l107.59,107.589l-272.34,272.34L56.604,361.465L328.883,89.125z M518.113,63.177l-47.981-47.981   c-18.543-18.543-48.653-18.543-67.259,0l-45.961,45.961l107.59,107.59l53.611-53.611   C532.495,100.753,532.495,77.559,518.113,63.177z M0.3,512.69c-1.958,8.812,5.998,16.708,14.811,14.565l119.891-29.069   L27.473,390.597L0.3,512.69z"/>
                                    </svg>
                                </a>
                            </td>
                            <th scope="row" class="align-middle"><?php echo $key + 1; ?></th>
                            <td class="align-middle">
                                <img class="img-fluid pb-2" style="width: 3em;"
                                     src="/template/images/<?php echo $product['image']; ?>"
                                     alt="<?php echo $product['title']; ?>">
                            </td>
                            <td class="align-middle"><?php echo $product['title']; ?></td>
                            <td class="align-middle">
                                <?php foreach ($categories as $category) {if ($category['id'] == $product['category_id']) echo $category['title'];} ?>
                            </td>
                            <td class="align-middle"><?php echo $product['product_id']; ?></td>
                            <td class="align-middle text-center">
                                <?php if ($product['availability']): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 492 492" height="1.4em" fill="currentColor" class="text-success align-middle pb-1">
                                        <path d="M484.128,104.478l-16.116-16.116c-5.064-5.068-11.816-7.856-19.024-7.856c-7.208,0-13.964,2.788-19.028,7.856    L203.508,314.81L62.024,173.322c-5.064-5.06-11.82-7.852-19.028-7.852c-7.204,0-13.956,2.792-19.024,7.852l-16.12,16.112    C2.784,194.51,0,201.27,0,208.47c0,7.204,2.784,13.96,7.852,19.028l159.744,159.736c0.212,0.3,0.436,0.58,0.696,0.836    l16.12,15.852c5.064,5.048,11.82,7.572,19.084,7.572h0.084c7.212,0,13.968-2.524,19.024-7.572l16.124-15.992    c0.26-0.256,0.48-0.468,0.612-0.684l244.784-244.76C494.624,132.01,494.624,114.966,484.128,104.478z"/>
                                    </svg>
                                <?php endif; ?>
                            </td>
                            <td class="align-middle text-center">
                                <?php if ($product['visibility']): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 492 492" height="1.4em" fill="currentColor" class="text-success align-middle pb-1">
                                        <path d="M484.128,104.478l-16.116-16.116c-5.064-5.068-11.816-7.856-19.024-7.856c-7.208,0-13.964,2.788-19.028,7.856    L203.508,314.81L62.024,173.322c-5.064-5.06-11.82-7.852-19.028-7.852c-7.204,0-13.956,2.792-19.024,7.852l-16.12,16.112    C2.784,194.51,0,201.27,0,208.47c0,7.204,2.784,13.96,7.852,19.028l159.744,159.736c0.212,0.3,0.436,0.58,0.696,0.836    l16.12,15.852c5.064,5.048,11.82,7.572,19.084,7.572h0.084c7.212,0,13.968-2.524,19.024-7.572l16.124-15.992    c0.26-0.256,0.48-0.468,0.612-0.684l244.784-244.76C494.624,132.01,494.624,114.966,484.128,104.478z"/>
                                    </svg>
                                <?php endif; ?>
                            </td>
                            <td class="align-middle text-center"><?php echo $product['volume']; ?></td>
                            <td class="align-middle text-center"><?php echo $product['unit']; ?></td>
                            <td class="align-middle text-right"><?php echo numfmt_format_currency($fmt, $product['price'], "UAH"); ?></td>
                            <td class="align-middle">
                                <a class="btn btn-outline-danger btn-sm border-0" href="/admin/product/delete/<?php echo $product['id']; ?>">
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
            <?php else: ?>
                <p>Тут ще немає жодного товару</p>
            <?php endif; ?>
        </div>
    </div>

<?php include_once ROOT . '/views/layouts/admin_footer.php'?>
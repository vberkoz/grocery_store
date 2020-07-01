<?php include_once ROOT . '/views/layouts/admin_header.php'?>

<div class="col-12">
    <div class="card mb-3 mx-auto">
        <div class="card-body">
            <a href="/admin/product/create" class="btn btn-primary mb-3">Додати товар</a>
            <?php if ($products): ?>
                <div class="row px-3">
                    <table class="table table-responsive-sm">
                        <thead>
                        <tr>
                            <th class="align-middle" scope="col">#</th>
                            <th class="align-middle" scope="col">Фото</th>
                            <th class="align-middle" scope="col">Назва</th>
                            <th class="align-middle" scope="col">
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Категорія
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <?php foreach ($categories as $category): ?>
                                            <a class="dropdown-item" href="/admin/product/<?php echo $category['id']; ?>">
                                                <?php echo $category['title']; ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </th>
                            <th class="align-middle" scope="col">Код</th>
                            <th class="align-middle" scope="col">Наявність</th>
                            <th class="align-middle" scope="col">Показувати</th>
                            <th class="align-middle" scope="col">Об'єм</th>
                            <th class="align-middle" scope="col">Одиниці</th>
                            <th class="align-middle text-right" scope="col">Ціна</th>
                            <th class="align-middle" scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($products as $key => $product): ?>
                            <tr class="product-record">
                                <th scope="row" class="align-middle"><?php echo $key + 1; ?></th>
                                <td class="align-middle">
                                    <img class="img-fluid" style="width: 3em;"
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
                                    <a class="btn btn-outline-secondary btn-sm border-0" href="/admin/product/update/<?php echo $product['id']; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 528 528" height="1.4em" fill="currentColor" class="align-middle pb-1">
                                            <path d="M328.883,89.125l107.59,107.589l-272.34,272.34L56.604,361.465L328.883,89.125z M518.113,63.177l-47.981-47.981   c-18.543-18.543-48.653-18.543-67.259,0l-45.961,45.961l107.59,107.59l53.611-53.611   C532.495,100.753,532.495,77.559,518.113,63.177z M0.3,512.69c-1.958,8.812,5.998,16.708,14.811,14.565l119.891-29.069   L27.473,390.597L0.3,512.69z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div>
                        <?php echo $pagination->get(); ?>
                    </div>
                </div>
            <?php else: ?>
                <p>Тут ще немає жодного товару</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include_once ROOT . '/views/layouts/admin_footer.php'?>
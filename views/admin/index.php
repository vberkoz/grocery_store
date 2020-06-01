<?php include_once ROOT . '/views/layouts/admin_header.php'?>

<div class="col-12">
    <?php if ($products): ?>
        <div class="card mb-3 mx-auto">
            <div class="card-body">
                <h5 class="card-title">Замовлено товарів за весь час</h5>
                <div class="row px-3">
                    <table class="table table-responsive-sm">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Фото</th>
                            <th scope="col">Назва</th>
                            <th scope="col" class="text-center">Об'єм</th>
                            <th scope="col" class="text-right">Сума</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="4"></td>
                            <td class="align-middle text-right"><strong><?php echo numfmt_format_currency($fmt, $total, "UAH"); ?></strong></td>
                        </tr>
                        <?php foreach ($products as $key => $product): ?>
                            <tr class="product-record">
                                <th scope="row" class="align-middle"><?php echo $key + 1; ?></th>
                                <td class="align-middle">
                                    <img class="img-fluid pb-2" style="width: 3em;"
                                         src="/template/images/<?php echo $product['image']; ?>"
                                         alt="<?php echo $product['title']; ?>">
                                </td>
                                <td class="align-middle"><?php echo $product['title']; ?></td>

                                <td class="align-middle text-center"><?php echo $product['volume'] . ' ' . $product['unit']; ?></td>
                                <td class="align-middle text-right"><?php echo numfmt_format_currency($fmt, $product['price'], "UAH"); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-secondary" role="alert">Замовлень ще немає</div>
    <?php endif; ?>
</div>

<div class="col-12">
    <div class="card mb-3 mx-auto">
        <div class="card-body">
            <h5 class="card-title">Запити на сторінку</h5>
            <table class="table table-sm table-responsive-sm">
                <thead>
                    <tr>
                        <th scope="col" style="min-width: 100px;">Дата</th>
                        <th scope="col">Адреса</th>
                        <th scope="col">Метод</th>
                        <th scope="col">Запит</th>
                        <th scope="col">Сесія</th>
                        <th scope="col">Користувач</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requests as $request): ?>
                        <tr>
                            <td><?php echo $request['REQUEST_TIME_FLOAT']; ?></td>
                            <td><?php echo $request['REMOTE_ADDR']; ?></td>
                            <td><?php echo $request['REQUEST_METHOD']; ?></td>
                            <td><?php echo $request['REQUEST_URI']; ?></td>
                            <td><?php echo $request['PHPSESSID']; ?></td>
                            <td><?php echo $request['USER_ID']; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3"><?php echo $request['HTTP_USER_AGENT']; ?></td>
                            <td colspan="2"><?php echo $request['HTTP_ACCEPT_LANGUAGE']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once ROOT . '/views/layouts/admin_footer.php'?>
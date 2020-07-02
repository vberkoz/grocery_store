<?php include_once ROOT . '/views/layouts/header.php'?>
<?php include_once ROOT . '/views/layouts/cabinet_menu.php'?>

    <aside class="col-md-9">
        <?php if ($orders): ?>
            <?php foreach ($orders as $order): ?>
                <article class="card mb-3">
                    <header class="card-header bg-white">
                        <b class="d-inline-block mr-3">Замовлення: <?php echo $order['id']; ?></b>
                        <span class="float-right"><?php echo date('Y-m-d H:i:s', strtotime($order['created_at'])); ?></span>
                    </header>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="text-muted">Оплата</h6>
                                <p>
                                    Товари: <?php echo numfmt_format_currency($fmt, $order['total'], "UAH"); ?><br>
                                    Знижка: <span class="text-danger"><?php echo numfmt_format_currency($fmt, $order['discount'], "UAH"); ?></span><br>
                                    <span class="b">Всього: <?php echo numfmt_format_currency($fmt, $order['total'] - $order['discount'], "UAH"); ?></span>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-muted">Замовник</h6>
                                <p><?php echo $order['user_name']; ?><br><?php echo $order['user_phone']; ?></p>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-muted">Адреса</h6>
                                <p><?php if ($order['user_address']) {echo $order['user_address'];} else {echo 'Не вказана';} ?></p>
                            </div>
                        </div> <!-- row.// -->
                        <hr>
                        <ul class="row m-0 p-0">
                            <?php foreach ($order['bag'] as $product): ?>
                                <div class="col-6 col-md-4 mb-2">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="/template/images/<?php echo $product['image']; ?>"
                                                 alt="<?php echo $product['image']; ?>" class="img-fluid">
                                        </div>
                                        <div class="col-md-8">
                                            <p class="title mb-0"><?php echo $product['title']; ?></p>
                                            <small>
                                                <div class="text-muted">
                                                    <span class="py-2">
                                                        <?php echo numfmt_format_currency($fmt, $product['item_total'], "UAH"); ?>
                                                    </span>
                                                    <span class="p-2">
                                                        <?php echo $product['quantity'] * $product['volume']; ?>
                                                        <?php if ($product['unit'] != 'кг') {echo 'г';} else {echo 'кг';} ?>
                                                    </span>
                                                </div>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </ul>
                    </div> <!-- card-body .// -->
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="d-flex justify-content-center w-100">
                <div class="alert alert-info" role="alert">Немає замовлень</div>
            </div>
        <?php endif; ?>
    </aside>

<?php include_once ROOT . '/views/layouts/footer.php'?>
<?php include_once ROOT . '/views/layouts/admin_header.php'?>

    <article class="card mb-3 w-100">
        <header class="card-header bg-white">
            <b class="d-inline-block mr-3">Замовлення: <?php echo $order['id']; ?></b>
            <span>Дата: <?php echo date("m j, Y, G:i", strtotime($order['created_at'])); ?></span>
            <div class="form-group d-inline-block float-right m-0">
                <select class="form-control form-control-sm order-status" name="order_status" order-id="<?php echo $order['id']; ?>">
                    <?php foreach (Order::STATUS_CAPTIONS as $key => $value): ?>
                        <option value="<?php echo $key; ?>"
                            <?php if ($key == $order['order_status']) echo ' selected="selected"'; ?>>
                            <?php echo $value; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div> <!-- form-group end.// -->
        </header>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <h6 class="text-muted">Оплата</h6>
                    <p>
                        Товари: <?php echo numfmt_format_currency($fmt, $order['total'], "UAH"); ?><br>
                        <span class="text-danger">Знижка: <?php echo numfmt_format_currency($fmt, $discount, "UAH"); ?></span><br>
                        <span class="b">Всього: <?php echo numfmt_format_currency($fmt, $total, "UAH"); ?></span>
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
                    <div class="col-6 col-md-3 mb-2">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="/template/images/<?php echo $product['image']; ?>"
                                     alt="<?php echo $product['image']; ?>" class="img-fluid border pb-3">
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

    <div class="d-none">
        <h2>Order #<?php echo $order['id']; ?></h2>
        <form action="#" method="post">
            <table style="margin-top: 20px;">
                <tr><td>Order number</td><td><?php echo $order['id']; ?></td></tr>
                <tr><td>Client name</td><td><?php echo $order['user_name']; ?></td></tr>
                <tr><td>Client phone</td><td><?php echo $order['user_phone']; ?></td></tr>
                <tr><td>Client comment</td><td><?php echo $order['user_comment']; ?></td></tr>
                <tr><td>Client ID</td><td><?php echo $order['user_id']; ?></td></tr>
                <tr>
                    <td><strong>Order status</strong></td>
                    <td>
                        <select name="order_status">
                            <?php foreach (Order::STATUS_CAPTIONS as $key => $value): ?>
                                <option value="<?php echo $key; ?>"
                                    <?php if ($key == $order['order_status']) echo ' selected="selected"'; ?>>
                                    <?php echo $value; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr><td><strong>Order date</strong></td><td><?php echo $order['created_at']; ?></td></tr>
            </table>
            <h3>Order products</h3>
            <table>
                <tr><th>ID</th><th>Product ID</th><th>Title</th><th>Price</th><th>Count</th></tr>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo $product['product_id']; ?></td>
                        <td><?php echo $product['title']; ?></td>
                        <td>£<?php echo $product['price']; ?></td>
                        <td><?php echo $productsCount[$product['id']]; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <input type="submit" name="submit" value="Save">
        </form>
    </div>

<?php include_once ROOT . '/views/layouts/admin_footer.php'?>
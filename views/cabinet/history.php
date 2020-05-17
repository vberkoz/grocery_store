<?php include_once ROOT . '/views/layouts/header.php'?>
<?php include_once ROOT . '/views/layouts/cabinet_menu.php'?>
<aside class="col-md-9">
    <?php foreach ($orders as $order): ?>
        <article class="card mb-3">
            <header class="card-header bg-white">
                <b class="d-inline-block mr-3">Order ID: <?php echo $order['id']; ?></b>
                <span>Date: <?php echo date("F j, Y, g:i a", strtotime($order['created_at'])); ?></span>
                <span class="<?php echo Order::STATUS_CAPTIONS_CSS[$order['order_status']]; ?> float-right">
                    <?php echo Order::STATUS_CAPTIONS[$order['order_status']]; ?>
                </span>
            </header>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h6 class="text-muted">Payment</h6>
                        <p>Subtotal: <?php echo numfmt_format_currency($fmt, $order['total'], "GBP"); ?><br>
                            <span class="b">Total: <?php echo numfmt_format_currency($fmt, $order['total'], "GBP"); ?></span>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-muted">Contact</h6>
                        <p><?php echo $order['user_name']; ?><br><?php echo $order['user_phone']; ?></p>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-muted">Shipping address</h6>
                        <p><?php echo $order['user_address']; ?></p>
                    </div>
                </div> <!-- row.// -->
                <hr>
                <ul class="row m-0 p-0">
                    <?php foreach ($order['bag'] as $product): ?>
                        <div class="col-md-4 mb-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="/product/<?php echo $product['id']; ?>/<?php echo $product['category_id']; ?>">
                                        <img src="/template/images/<?php echo $product['image']; ?>"
                                             alt="<?php echo $product['image']; ?>" class="img-fluid border">
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <p class="title mb-0" style="min-height: 48px;max-height: 48px;"><?php echo $product['title']; ?></p>
                                    <span class="text-muted">
                                        <?php echo $product['quantity'] . ' * ' . numfmt_format_currency($fmt, $product['price'], "GBP") . ' = ' . numfmt_format_currency($fmt, $product['item_total'], "GBP"); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </ul>
            </div> <!-- card-body .// -->
        </article>
    <?php endforeach; ?>
</aside>
<?php include_once ROOT . '/views/layouts/footer.php'?>
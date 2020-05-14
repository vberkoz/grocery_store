<?php include_once ROOT . '/views/layouts/header.php'?>

<?php if ($bag): ?>
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <table>
                    <thead>
                        <tr class="small text-uppercase text-muted">
                            <th scope="col" class="px-3">Product</th>
                            <th scope="col" class="px-3" width="150">Quantity</th>
                            <th scope="col" class="px-3" width="150">Price</th>
                            <th scope="col" class="text-right d-none d-md-block px-3" width="170"> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td class="p-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="/product/<?php echo $product['id']; ?>/<?php echo $product['category_id']; ?>">
                                                <img class="img-fluid"
                                                     src="/template/images/<?php echo $product['image']; ?>"
                                                     alt="<?php echo $product['title']; ?>">
                                            </a>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="m-0"><?php echo $product['title']; ?></p>
                                            <small class="text-muted">Brand: <?php echo $product['brand']; ?></small><br>
                                            <small class="text-muted">Article: <?php echo $product['product_id']; ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" type="button" id="button-plus"> + </button>
                                        </div>
                                        <input type="text" class="form-control text-center" value="<?php echo $bag[$product['id']]; ?>">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="button-minus"> − </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3">
                                    <p>
                                        <?php echo numfmt_format_currency($fmt, $product['price'] * $bag[$product['id']], "GBP"); ?>
                                        <br>
                                        <small class="text-muted"><?php echo numfmt_format_currency($fmt, $product['price'], "GBP") . ' each'; ?></small>
                                    </p>
                                </td>
                                <td class="p-3">
                                    <button type="button" class="btn btn-outline-secondary">
                                        <svg class="bi bi-heart-fill align-middle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                    <a class="btn btn-outline-secondary" href="/bag/remove/<?php echo $product['id']; ?>">Remove</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between m-0">
                    <p class="m-0">Total price:</p>
                    <p class="m-0"><?php echo numfmt_format_currency($fmt, $totalPrice, "GBP"); ?></p>
                </div>
                <div class="d-flex justify-content-between m-0">
                    <p class="m-0">Discount:</p>
                    <p class="m-0 text-danger"><?php echo '- ' . numfmt_format_currency($fmt, 10, "GBP"); ?></p>
                </div>
                <div class="d-flex justify-content-between m-0">
                    <p class="m-0">Total:</p>
                    <p class="m-0"><b><?php echo numfmt_format_currency($fmt, $totalPrice - 10, "GBP"); ?></b></p>
                </div>
                <hr>
                <a href="/bag/checkout" class="btn btn-primary btn-block">Check Out</a>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="d-flex justify-content-center w-100">
        <div class="alert alert-info" role="alert">Bag is empty</div>
    </div>
<?php endif; ?>

<?php include_once ROOT . '/views/layouts/footer.php'?>
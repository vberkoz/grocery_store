<?php include_once ROOT . '/views/layouts/header.php'?>
<?php include_once ROOT . '/views/layouts/catalog.php'?>

<aside class="col-md-9">
    <?php foreach ($products as $key => $product): ?>
        <?php if (($key + 1) % 4 == 1) echo '<div class="row">' ?>
        <div class="col-md-3 pl-1 pr-1 pb-2">
            <div class="card h-100">
                <a href="/product/<?php echo $product['id']; ?>/<?php echo $product['category_id']; ?>">
                    <img class="card-img-top" src="/template/images/<?php echo $product['image']; ?>" alt="<?php echo $product['title']; ?>">
                </a>
                <div class="card-body d-flex flex-column justify-content-between">
                    <p class="card-text"><?php echo $product['title']; ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <strong><?php echo numfmt_format_currency($fmt, $product['price'], "GBP"); ?></strong>
                        <a href="#" class="add-to-bag btn btn-outline-primary btn-sm" data-id="<?php echo $product['id']; ?>">
                            Add to bag
                            <svg class="bi bi-bag-fill position-relative" width="1em" height="1em" viewBox="0 -2 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 4h14v10a2 2 0 01-2 2H3a2 2 0 01-2-2V4zm7-2.5A2.5 2.5 0 005.5 4h-1a3.5 3.5 0 117 0h-1A2.5 2.5 0 008 1.5z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php if (($key + 1) % 4 == 0) echo '</div>' ?>
    <?php endforeach; ?>
    <?php if (($key + 1) % 4 !== 0) echo '</div>' ?>

    <div style="margin-left: -11px;">
        <?php echo $pagination->get(); ?>
    </div>
</aside>

<?php include_once ROOT . '/views/layouts/footer.php'?>
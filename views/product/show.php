<?php include_once ROOT . '/views/layouts/header.php'?>
<?php include_once ROOT . '/views/layouts/catalog.php'?>

<aside class="col-md-9">
    <div class="card d-flex flex-row">
        <aside class="col-md-6 p-0">
            <img class="img-fluid" src="/template/images/<?php echo $product['image']; ?>" alt="<?php echo $product['title']; ?>">
        </aside>
        <main class="col-md-6 border-left p-4 d-flex flex-column justify-content-between">
            <div>
                <h2><?php echo $product['title']; ?></h2>
                <p><?php echo $product['description']; ?></p>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <h3><?php echo numfmt_format_currency($fmt, $product['price'], "GBP"); ?></h3>
                <div>
                    <button type="button" class="btn btn-outline-secondary">
                        <svg class="bi bi-heart-fill align-middle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                    <button type="button"
                             class="btn btn-primary add-to-bag"
                             data-id="<?php echo $product['id']; ?>">Add to bag
                        <svg class="bi bi-bag-fill position-relative" width="1em" height="1em" viewBox="0 -2 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 4h14v10a2 2 0 01-2 2H3a2 2 0 01-2-2V4zm7-2.5A2.5 2.5 0 005.5 4h-1a3.5 3.5 0 117 0h-1A2.5 2.5 0 008 1.5z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </main>
    </div>
</aside>

<?php include_once ROOT . '/views/layouts/footer.php'?>
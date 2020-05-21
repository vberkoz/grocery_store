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
                             data-id="<?php echo $product['id']; ?>">
                        Add to bag
                        <svg class="align-middle pb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="1.5em" fill="currentColor">
                            <g>
                                <path d="M447.988,139.696c-0.156-2.084-1.9-3.696-3.988-3.696h-72v-20C372,52.036,319.96,0,256,0S140,52.036,140,116v20H68    c-2.088,0-3.832,1.612-3.988,3.696l-28,368c-0.084,1.108,0.296,2.204,1.056,3.02C37.824,511.536,38.888,512,40,512h432    c1.112,0,2.176-0.464,2.932-1.28c0.756-0.816,1.14-1.912,1.056-3.02L447.988,139.696z M172,116c0-46.316,37.68-84,84-84    s84,37.684,84,84v20H172V116z M156,248c-22.06,0-40-17.944-40-40c0-15.964,8-30.348,24-36.66V208c0,8.824,7.18,16,16,16    s16-7.176,16-16v-36.636c16,6.312,24,20.804,24,36.636C196,230.056,178.06,248,156,248z M356,248c-22.06,0-40-17.944-40-40    c0-15.964,8-30.348,24-36.66V208c0,8.824,7.18,16,16,16s16-7.176,16-16v-36.636c16,6.312,24,20.804,24,36.636    C396,230.056,378.06,248,356,248z"/>
                            </g>
                        </svg>
                    </button>
                </div>
            </div>
        </main>
    </div>
</aside>

<?php include_once ROOT . '/views/layouts/footer.php'?>
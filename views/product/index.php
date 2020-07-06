<?php include_once ROOT . '/views/layouts/header.php'?>

<aside class="col-md-12">
    <div class="alert alert-info" role="alert">
        Сьогодні ми доставляємо замовлення які були здійснені вчора і сьогодні до 4-ї години ранку. Решта замовлень будуть оброблені завтра.
    </div>
    <div class="row" id="products">
    <?php foreach ($products as $key => $product): ?>
        <div class="col-6 col-md-2 pl-1 pr-1 pb-2 product-card" data-id="<?php echo $product['id']; ?>">
            <div class="card h-100">
                <button class="btn btn-outline-primary border-0 btn-sm position-absolute float-right m-2 invisible like"
                        style="right: 0;z-index: 1;" data-id="<?php echo $product['id']; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 456" height="1.3em" fill="currentColor" class="align-middle pb-1">
                        <path d="m471.382812 44.578125c-26.503906-28.746094-62.871093-44.578125-102.410156-44.578125-29.554687 0-56.621094 9.34375-80.449218 27.769531-12.023438 9.300781-22.917969 20.679688-32.523438 33.960938-9.601562-13.277344-20.5-24.660157-32.527344-33.960938-23.824218-18.425781-50.890625-27.769531-80.445312-27.769531-39.539063 0-75.910156 15.832031-102.414063 44.578125-26.1875 28.410156-40.613281 67.222656-40.613281 109.292969 0 43.300781 16.136719 82.9375 50.78125 124.742187 30.992188 37.394531 75.535156 75.355469 127.117188 119.3125 17.613281 15.011719 37.578124 32.027344 58.308593 50.152344 5.476563 4.796875 12.503907 7.4375 19.792969 7.4375 7.285156 0 14.316406-2.640625 19.785156-7.429687 20.730469-18.128907 40.707032-35.152344 58.328125-50.171876 51.574219-43.949218 96.117188-81.90625 127.109375-119.304687 34.644532-41.800781 50.777344-81.4375 50.777344-124.742187 0-42.066407-14.425781-80.878907-40.617188-109.289063zm0 0"/>
                    </svg>
                </button>
                <div class="px-4 pt-4">
                    <img class="card-img-top" <?php if (!$product['availability']) echo 'style="opacity: 0.5;"'; ?>
                         src="/template/images/<?php echo $product['image']; ?>" alt="<?php echo $product['title']; ?>">
                </div>

                <div class="card-body d-flex flex-column justify-content-between p-3">
                    <?php if ($product['availability']): ?>
                        <a href="#" class="add-to-bag-first btn btn-outline-primary btn-sm invisible"
                           data-id="<?php echo $product['id']; ?>"
                           data-unit="<?php echo $product['unit']; ?>"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="1.3em"
                                 fill="currentColor" class="align-middle pb-1">
                                <path d="M447.988,139.696c-0.156-2.084-1.9-3.696-3.988-3.696h-72v-20C372,52.036,319.96,0,256,0S140,52.036,140,116v20H68    c-2.088,0-3.832,1.612-3.988,3.696l-28,368c-0.084,1.108,0.296,2.204,1.056,3.02C37.824,511.536,38.888,512,40,512h432    c1.112,0,2.176-0.464,2.932-1.28c0.756-0.816,1.14-1.912,1.056-3.02L447.988,139.696z M172,116c0-46.316,37.68-84,84-84    s84,37.684,84,84v20H172V116z M156,248c-22.06,0-40-17.944-40-40c0-15.964,8-30.348,24-36.66V208c0,8.824,7.18,16,16,16    s16-7.176,16-16v-36.636c16,6.312,24,20.804,24,36.636C196,230.056,178.06,248,156,248z M356,248c-22.06,0-40-17.944-40-40    c0-15.964,8-30.348,24-36.66V208c0,8.824,7.18,16,16,16s16-7.176,16-16v-36.636c16,6.312,24,20.804,24,36.636    C396,230.056,378.06,248,356,248z"/>
                            </svg>
                        </a>

                        <div class="input-group input-group-sm d-none">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-outline-primary remove-from-bag"
                                        data-id="<?php echo $product['id']; ?>"
                                        data-volume_min="<?php echo $product['volume_min']; ?>"
                                        data-unit="<?php echo $product['unit']; ?>"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 459 459" height="0.6em"
                                         fill="currentColor" class="align-middle">
                                        <path d="M459.313,229.648c0,22.201-17.992,40.199-40.205,40.199H40.181c-11.094,0-21.14-4.498-28.416-11.774   C4.495,250.808,0,240.76,0,229.66c-0.006-22.204,17.992-40.199,40.202-40.193h378.936   C441.333,189.472,459.308,207.456,459.313,229.648z"/>
                                    </svg>
                                </button>
                            </div>

                            <input type="text" class="form-control text-center
                                   <?php if ($product['unit'] == 'шт') {
                                       echo 'input-int';
                                   } else {
                                       echo 'input-float';
                                   } ?>"
                                   data-id="<?php echo $product['id']; ?>"
                                   data-unit="<?php echo $product['unit']; ?>"
                            >

                            <div class="input-group-append">
                                <button type="button"
                                        class="btn btn-outline-primary add-to-bag-second"
                                        data-id="<?php echo $product['id']; ?>"
                                        data-volume_min="<?php echo $product['volume_min']; ?>"
                                        data-unit="<?php echo $product['unit']; ?>"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 448" height="0.8em"
                                         fill="currentColor" class="align-middle">
                                        <path d="m408 184h-136c-4.417969 0-8-3.582031-8-8v-136c0-22.089844-17.910156-40-40-40s-40 17.910156-40 40v136c0 4.417969-3.582031 8-8 8h-136c-22.089844 0-40 17.910156-40 40s17.910156 40 40 40h136c4.417969 0 8 3.582031 8 8v136c0 22.089844 17.910156 40 40 40s40-17.910156 40-40v-136c0-4.417969 3.582031-8 8-8h136c22.089844 0 40-17.910156 40-40s-17.910156-40-40-40zm0 0"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    <?php else: ?>
                        <button type="button" class="btn btn-sm btn-outline-secondary" disabled style="height: 38px;">Немає в наявності</button>
                    <?php endif; ?>

                    <p class="card-text pt-2" style="min-height: 48px;">
                        <?php echo $product['title']; ?>
                    </p>

                    <div class="d-flex justify-content-between">
                        <?php echo $product['volume'] . ' ' . $product['unit']; ?>
                        <strong><?php echo numfmt_format_currency($fmt, $product['price'], "UAH"); ?></strong>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
    <div style="margin-left: -11px;">
        <?php echo $pagination->get(); ?>
    </div>
</aside>

<?php include_once ROOT . '/views/layouts/footer.php'?>
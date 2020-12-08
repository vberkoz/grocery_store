<?php include_once ROOT . '/views/layouts/header.php' ?>

<div id="carouselExampleCaptions" class="carousel slide w-100" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class=""></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1" class=""></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2" class="active"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item">
            <img class="d-block w-100" data-src="holder.js/800x200?auto=yes&amp;bg=777&amp;fg=555&amp;text=First slide" alt="First slide [800x400]" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22800%22%20height%3D%22300%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20800%20400%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_175f58c2591%20text%20%7B%20fill%3A%23555%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A40pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_175f58c2591%22%3E%3Crect%20width%3D%22800%22%20height%3D%22400%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22285.921875%22%20y%3D%22217.7%22%3EFirst%20slide%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
            <div class="carousel-caption d-none d-md-block">
                <h5>First slide label</h5>
                <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" data-src="holder.js/800x200?auto=yes&amp;bg=666&amp;fg=444&amp;text=Second slide" alt="Second slide [800x400]" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22800%22%20height%3D%22300%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20800%20400%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_175f58c2592%20text%20%7B%20fill%3A%23444%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A40pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_175f58c2592%22%3E%3Crect%20width%3D%22800%22%20height%3D%22400%22%20fill%3D%22%23666%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22247.3125%22%20y%3D%22217.7%22%3ESecond%20slide%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
            <div class="carousel-caption d-none d-md-block">
                <h5>Second slide label</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>
        <div class="carousel-item active">
            <img class="d-block w-100" data-src="holder.js/800x200?auto=yes&amp;bg=555&amp;fg=333&amp;text=Third slide" alt="Third slide [800x400]" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22800%22%20height%3D%22300%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20800%20400%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_175f58c2593%20text%20%7B%20fill%3A%23333%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A40pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_175f58c2593%22%3E%3Crect%20width%3D%22800%22%20height%3D%22400%22%20fill%3D%22%23555%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22277%22%20y%3D%22217.7%22%3EThird%20slide%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
            <div class="carousel-caption d-none d-md-block">
                <h5>Third slide label</h5>
                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="col-sm-12 p-1">
    <div class="d-flex justify-content-between px-1 pt-3">
        <h4 class="pt-2">Популярні товари</h4>
        <div class="pb-2">
            <button type="button" class="carousel-prev btn btn-outline-primary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" height="1.2em"
                     fill="currentColor" class="align-middle pb-1">
                    <polygon points="207.093,30.187 176.907,0 48.907,128 176.907,256 207.093,225.813 109.28,128"/>
                </svg>
            </button>
            <button type="button" class="carousel-next btn btn-outline-primary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" height="1.2em"
                     fill="currentColor" class="align-middle pb-1">
                    <polygon points="79.093,0 48.907,30.187 146.72,128 48.907,225.813 79.093,256 207.093,128"/>
                </svg>
            </button>
        </div>
    </div>

    <div class="products">
        <?php foreach ($products as $key => $item): ?>
            <div class="col-xl-2 col-md-3 col-6 px-1 pb-2 product-card" data-id="<?php echo $item['id']; ?>">
                <div class="card">
                    <div class="px-4 pt-4">
                        <a href="/product/<?php echo $item['slug']; ?>">
                            <img class="card-img-top" <?php if (!$item['availability']) echo 'style="opacity: 0.5;"'; ?>
                                 src="/template/images/<?php echo $item['image']; ?>"
                                 alt="<?php echo $item['title']; ?>">
                        </a>
                    </div>

                    <div class="card-body d-flex flex-column justify-content-between p-3">
                        <?php if ($item['availability']): ?>
                            <a href="#" class="add-to-bag-first btn btn-outline-primary btn-sm invisible"
                               data-id="<?php echo $item['id']; ?>" data-unit="<?php echo $item['unit']; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="1.3em"
                                     fill="currentColor" class="align-middle pb-1">
                                    <path d="M447.988,139.696c-0.156-2.084-1.9-3.696-3.988-3.696h-72v-20C372,52.036,319.96,0,256,0S140,52.036,140,116v20H68    c-2.088,0-3.832,1.612-3.988,3.696l-28,368c-0.084,1.108,0.296,2.204,1.056,3.02C37.824,511.536,38.888,512,40,512h432    c1.112,0,2.176-0.464,2.932-1.28c0.756-0.816,1.14-1.912,1.056-3.02L447.988,139.696z M172,116c0-46.316,37.68-84,84-84    s84,37.684,84,84v20H172V116z M156,248c-22.06,0-40-17.944-40-40c0-15.964,8-30.348,24-36.66V208c0,8.824,7.18,16,16,16    s16-7.176,16-16v-36.636c16,6.312,24,20.804,24,36.636C196,230.056,178.06,248,156,248z M356,248c-22.06,0-40-17.944-40-40    c0-15.964,8-30.348,24-36.66V208c0,8.824,7.18,16,16,16s16-7.176,16-16v-36.636c16,6.312,24,20.804,24,36.636    C396,230.056,378.06,248,356,248z"/>
                                </svg>
                            </a>

                            <div class="input-group input-group-sm d-none">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-outline-primary remove-from-bag"
                                            data-id="<?php echo $item['id']; ?>"
                                            data-volume_min="<?php echo $item['volume_min']; ?>"
                                            data-unit="<?php echo $item['unit']; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 459 459"
                                             height="0.6em"
                                             fill="currentColor" class="align-middle">
                                            <path d="M459.313,229.648c0,22.201-17.992,40.199-40.205,40.199H40.181c-11.094,0-21.14-4.498-28.416-11.774   C4.495,250.808,0,240.76,0,229.66c-0.006-22.204,17.992-40.199,40.202-40.193h378.936   C441.333,189.472,459.308,207.456,459.313,229.648z"/>
                                        </svg>
                                    </button>
                                </div>

                                <input type="text" class="form-control text-center
                                        <?php if ($item['unit'] == 'шт') {
                                    echo 'input-int';
                                } else {
                                    echo 'input-float';
                                } ?>"
                                       data-id="<?php echo $item['id']; ?>"
                                       data-unit="<?php echo $item['unit']; ?>">

                                <div class="input-group-append">
                                    <button type="button"
                                            class="btn btn-outline-primary add-to-bag-second"
                                            data-id="<?php echo $item['id']; ?>"
                                            data-volume_min="<?php echo $item['volume_min']; ?>"
                                            data-unit="<?php echo $item['unit']; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 448"
                                             height="0.8em"
                                             fill="currentColor" class="align-middle">
                                            <path d="m408 184h-136c-4.417969 0-8-3.582031-8-8v-136c0-22.089844-17.910156-40-40-40s-40 17.910156-40 40v136c0 4.417969-3.582031 8-8 8h-136c-22.089844 0-40 17.910156-40 40s17.910156 40 40 40h136c4.417969 0 8 3.582031 8 8v136c0 22.089844 17.910156 40 40 40s40-17.910156 40-40v-136c0-4.417969 3.582031-8 8-8h136c22.089844 0 40-17.910156 40-40s-17.910156-40-40-40zm0 0"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        <?php else: ?>
                            <button type="button" class="btn btn-sm btn-outline-secondary" disabled
                                    style="height: 38px;">Немає в наявності
                            </button>
                        <?php endif; ?>

                        <p class="card-text pt-2" style="min-height: 48px;">
                            <?php echo $item['title']; ?></p>

                        <div class="d-flex justify-content-between align-items-end">
                            <?php echo $item['volume'] . ' ' . $item['unit']; ?>
                            <div>
                                <div>
                                    <?php $discount = $item['currency'] + ($item['price'] / 100 * $item['percent']);
                                    if ($discount) echo '<strike>' . numfmt_format_currency($fmt, $item['price'], "UAH") . '</strike>'; ?>
                                </div>
                                <div>
                                    <strong><?php echo numfmt_format_currency($fmt, $item['price'] - $discount, "UAH"); ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="col-sm-12 p-1">
    <div class="d-flex justify-content-between px-1 pt-3">
        <h4 class="pt-2">Нові товари</h4>
        <div class="pb-2">
            <button type="button" class="carousel-prev btn btn-outline-primary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" height="1.2em"
                     fill="currentColor" class="align-middle pb-1">
                    <polygon points="207.093,30.187 176.907,0 48.907,128 176.907,256 207.093,225.813 109.28,128"/>
                </svg>
            </button>
            <button type="button" class="carousel-next btn btn-outline-primary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" height="1.2em"
                     fill="currentColor" class="align-middle pb-1">
                    <polygon points="79.093,0 48.907,30.187 146.72,128 48.907,225.813 79.093,256 207.093,128"/>
                </svg>
            </button>
        </div>
    </div>

    <div class="products">
        <?php foreach ($products as $key => $item): ?>
            <div class="col-xl-2 col-md-3 col-6 px-1 pb-2 product-card" data-id="<?php echo $item['id']; ?>">
                <div class="card">
                    <div class="px-4 pt-4">
                        <a href="/product/<?php echo $item['slug']; ?>">
                            <img class="card-img-top" <?php if (!$item['availability']) echo 'style="opacity: 0.5;"'; ?>
                                 src="/template/images/<?php echo $item['image']; ?>"
                                 alt="<?php echo $item['title']; ?>">
                        </a>
                    </div>

                    <div class="card-body d-flex flex-column justify-content-between p-3">
                        <?php if ($item['availability']): ?>
                            <a href="#" class="add-to-bag-first btn btn-outline-primary btn-sm invisible"
                               data-id="<?php echo $item['id']; ?>" data-unit="<?php echo $item['unit']; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="1.3em"
                                     fill="currentColor" class="align-middle pb-1">
                                    <path d="M447.988,139.696c-0.156-2.084-1.9-3.696-3.988-3.696h-72v-20C372,52.036,319.96,0,256,0S140,52.036,140,116v20H68    c-2.088,0-3.832,1.612-3.988,3.696l-28,368c-0.084,1.108,0.296,2.204,1.056,3.02C37.824,511.536,38.888,512,40,512h432    c1.112,0,2.176-0.464,2.932-1.28c0.756-0.816,1.14-1.912,1.056-3.02L447.988,139.696z M172,116c0-46.316,37.68-84,84-84    s84,37.684,84,84v20H172V116z M156,248c-22.06,0-40-17.944-40-40c0-15.964,8-30.348,24-36.66V208c0,8.824,7.18,16,16,16    s16-7.176,16-16v-36.636c16,6.312,24,20.804,24,36.636C196,230.056,178.06,248,156,248z M356,248c-22.06,0-40-17.944-40-40    c0-15.964,8-30.348,24-36.66V208c0,8.824,7.18,16,16,16s16-7.176,16-16v-36.636c16,6.312,24,20.804,24,36.636    C396,230.056,378.06,248,356,248z"/>
                                </svg>
                            </a>

                            <div class="input-group input-group-sm d-none">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-outline-primary remove-from-bag"
                                            data-id="<?php echo $item['id']; ?>"
                                            data-volume_min="<?php echo $item['volume_min']; ?>"
                                            data-unit="<?php echo $item['unit']; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 459 459"
                                             height="0.6em"
                                             fill="currentColor" class="align-middle">
                                            <path d="M459.313,229.648c0,22.201-17.992,40.199-40.205,40.199H40.181c-11.094,0-21.14-4.498-28.416-11.774   C4.495,250.808,0,240.76,0,229.66c-0.006-22.204,17.992-40.199,40.202-40.193h378.936   C441.333,189.472,459.308,207.456,459.313,229.648z"/>
                                        </svg>
                                    </button>
                                </div>

                                <input type="text" class="form-control text-center
                                        <?php if ($item['unit'] == 'шт') {
                                    echo 'input-int';
                                } else {
                                    echo 'input-float';
                                } ?>"
                                       data-id="<?php echo $item['id']; ?>"
                                       data-unit="<?php echo $item['unit']; ?>">

                                <div class="input-group-append">
                                    <button type="button"
                                            class="btn btn-outline-primary add-to-bag-second"
                                            data-id="<?php echo $item['id']; ?>"
                                            data-volume_min="<?php echo $item['volume_min']; ?>"
                                            data-unit="<?php echo $item['unit']; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 448"
                                             height="0.8em"
                                             fill="currentColor" class="align-middle">
                                            <path d="m408 184h-136c-4.417969 0-8-3.582031-8-8v-136c0-22.089844-17.910156-40-40-40s-40 17.910156-40 40v136c0 4.417969-3.582031 8-8 8h-136c-22.089844 0-40 17.910156-40 40s17.910156 40 40 40h136c4.417969 0 8 3.582031 8 8v136c0 22.089844 17.910156 40 40 40s40-17.910156 40-40v-136c0-4.417969 3.582031-8 8-8h136c22.089844 0 40-17.910156 40-40s-17.910156-40-40-40zm0 0"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        <?php else: ?>
                            <button type="button" class="btn btn-sm btn-outline-secondary" disabled
                                    style="height: 38px;">Немає в наявності
                            </button>
                        <?php endif; ?>

                        <p class="card-text pt-2" style="min-height: 48px;">
                            <?php echo $item['title']; ?></p>

                        <div class="d-flex justify-content-between align-items-end">
                            <?php echo $item['volume'] . ' ' . $item['unit']; ?>
                            <div>
                                <div>
                                    <?php $discount = $item['currency'] + ($item['price'] / 100 * $item['percent']);
                                    if ($discount) echo '<strike>' . numfmt_format_currency($fmt, $item['price'], "UAH") . '</strike>'; ?>
                                </div>
                                <div>
                                    <strong><?php echo numfmt_format_currency($fmt, $item['price'] - $discount, "UAH"); ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Bootstrap -->
<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>

<!-- Product slider -->
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.products').slick({
            infinite: false,
            speed: 300,
            slidesToShow: 8,
            slidesToScroll: 1,
            arrows: false,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        infinite: true
                    }
                },
                {
                    breakpoint: 769,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    });

    // Custom carousel nav
    $('.carousel-prev').click(function () {
        $(this).parent().parent().parent().find('.products').slick('slickPrev');
    });

    $('.carousel-next').click(function (e) {
        e.preventDefault();
        $(this).parent().parent().parent().find('.products').slick('slickNext');
    });
</script>

<?php include_once ROOT . '/views/layouts/footer.php' ?>

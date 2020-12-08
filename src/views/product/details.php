<?php include_once ROOT . '/views/layouts/header.php' ?>

<aside class="container-fluid">
    <div class="row" id="products">
        <div class="col-md-12 col-xl-8 offset-xl-2 p-1">
            <nav class="card" aria-label="breadcrumb">
                <ol class="breadcrumb m-0" style="background-color: rgba(255, 255, 128, .0)">
                    <li class="breadcrumb-item"><a href="/">Головна</a></li>
                    <li class="breadcrumb-item">
                        <a href="/category/<?php echo $product['category_slug'] ?>"><?php echo $product['category_title'] ?></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $product['title'] ?></li>
                </ol>
            </nav>
        </div>

        <div class="col-md-6 col-xl-4 offset-xl-2 p-1">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center">
                    <img class="align-middle mx-auto d-block img-fluid"
                         src="/template/images/<?php echo $product['image']; ?>" alt="<?php echo $product['title']; ?>">
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4 p-1">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted"><small><strong>Код
                                товару: <?php echo $product['code'] ?></strong></small></p>

                    <h1 class="card-title"><strong><?php echo $product['title']; ?></strong></h1>

                    <p class="text-muted">
                        <small>Ціна за <?php echo $product['volume'] . ' ' . $product['unit']; ?></small><br>

                        <small>Мін. замовлення <?php echo $product['volume_min'] . ' ' . $product['unit'] ?></small>
                    </p>

                    <div>
                        <div class="h1">
                            <?php $discount = $product['currency'] + ($product['price'] / 100 * $product['percent']);
                            if ($discount) echo '<strike>' . numfmt_format_currency($fmt, $product['price'], "UAH") . '</strike>'; ?>
                            <?php echo numfmt_format_currency($fmt, $product['price'] - $discount, "UAH"); ?>
                        </div>

                        <div class="d-flex flex-column justify-content-between">
                            <?php if ($product['availability']): ?>
                                <a href="#" class="add-to-bag-first btn btn-outline-primary"
                                   data-id="<?php echo $product['id']; ?>" data-unit="<?php echo $product['unit']; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="1.3em"
                                         fill="currentColor" class="align-middle pb-1">
                                        <path d="M447.988,139.696c-0.156-2.084-1.9-3.696-3.988-3.696h-72v-20C372,52.036,319.96,0,256,0S140,52.036,140,116v20H68    c-2.088,0-3.832,1.612-3.988,3.696l-28,368c-0.084,1.108,0.296,2.204,1.056,3.02C37.824,511.536,38.888,512,40,512h432    c1.112,0,2.176-0.464,2.932-1.28c0.756-0.816,1.14-1.912,1.056-3.02L447.988,139.696z M172,116c0-46.316,37.68-84,84-84    s84,37.684,84,84v20H172V116z M156,248c-22.06,0-40-17.944-40-40c0-15.964,8-30.348,24-36.66V208c0,8.824,7.18,16,16,16    s16-7.176,16-16v-36.636c16,6.312,24,20.804,24,36.636C196,230.056,178.06,248,156,248z M356,248c-22.06,0-40-17.944-40-40    c0-15.964,8-30.348,24-36.66V208c0,8.824,7.18,16,16,16s16-7.176,16-16v-36.636c16,6.312,24,20.804,24,36.636    C396,230.056,378.06,248,356,248z"/>
                                    </svg>

                                    Покласти в кошик
                                </a>

                                <div class="input-group d-none">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-outline-primary remove-from-bag"
                                                data-id="<?php echo $product['id']; ?>"
                                                data-volume_min="<?php echo $product['volume_min']; ?>"
                                                data-unit="<?php echo $product['unit']; ?>">
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
                                           data-unit="<?php echo $product['unit']; ?>">

                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-primary add-to-bag-second"
                                                data-id="<?php echo $product['id']; ?>"
                                                data-volume_min="<?php echo $product['volume_min']; ?>"
                                                data-unit="<?php echo $product['unit']; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 448" height="0.8em"
                                                 fill="currentColor" class="align-middle">
                                                <path d="m408 184h-136c-4.417969 0-8-3.582031-8-8v-136c0-22.089844-17.910156-40-40-40s-40 17.910156-40 40v136c0 4.417969-3.582031 8-8 8h-136c-22.089844 0-40 17.910156-40 40s17.910156 40 40 40h136c4.417969 0 8 3.582031 8 8v136c0 22.089844 17.910156 40 40 40s40-17.910156 40-40v-136c0-4.417969 3.582031-8 8-8h136c22.089844 0 40-17.910156 40-40s-17.910156-40-40-40zm0 0"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            <?php else: ?>
                                <button type="button" class="btn btn-outline-secondary" disabled style="height: 38px;">
                                    Немає в наявності
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-body">
                    <h4 class="card-title">Характеристики</h4>
                    <hr>
                    <?php if ($product['characteristics']): ?>
                        <ul>
                            <?php foreach ($product['characteristics'] as $key => $value): ?>
                                <li><strong><?php echo $key; ?>: </strong><?php echo $value; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <div class="my-4">
                            <h5 class="text-center">Характеристики відсутні</h5>
                            <p class="text-center">Ми працюємо над вдосконаленням нашого сервісу.<br>Характеристики
                                товару незабаром з'являться.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4 offset-xl-2 p-1">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Корисна інформація</h4>
                    <hr>
                    <?php if ($product['description']): ?>
                        <p class="card-text"><?php echo $product['description']; ?></p>
                    <?php else: ?>
                        <div class="my-4">
                            <h5 class="text-center">Інформація відсутня</h5>
                            <p class="text-center">Ми працюємо над вдосконаленням нашого сервісу.<br>Інформація про
                                товар незабаром з'явиться.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4 p-1">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">Відгуки</h4>
                        <button type="button" class="btn btn-sm btn-link" data-toggle="modal"
                                data-target="#productReview">Написати
                        </button>
                        <div class="modal fade" id="productReview" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Ваш відгук</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <input type="text" id="product_id" class="d-none"
                                                   value="<?php echo $product['id'] ?>">
                                            <div class="form-group">
                                                <label for="reviewer_name">Ім'я</label>
                                                <input type="text" class="form-control" id="reviewer_name"
                                                       placeholder="Ваше ім'я">
                                            </div>
                                            <div class="form-group">
                                                <label for="reviewer_email">Електронна пошта</label>
                                                <input type="email" class="form-control" id="reviewer_email"
                                                       placeholder="name@example.com">
                                            </div>
                                            <div class="form-group">
                                                <label for="reviewer_text">Відгук</label>
                                                <textarea class="form-control" id="reviewer_text" rows="3"
                                                          placeholder="Ваш відгук"></textarea>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Відміна
                                        </button>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal"
                                                onclick="saveReview()">Зберегти
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div id="reviews">
                        <?php if ($reviews): ?>
                            <?php foreach ($reviews as $item): ?>
                                <p><strong><?php echo $item['name']; ?></strong><br><?php echo $item['text']; ?></p>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="my-4">
                                <h5 class="text-center">Відгуків ще немає</h5>
                                <p class="text-center">Поділіться своїми думками про цей товар</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 p-1">
            <div class="d-flex justify-content-between px-1 pt-3">
                <h4 class="pt-2">Інші товари</h4>
                <div class="pb-2">
                    <button type="button" class="carousel-prev btn btn-outline-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" height="1.2em"
                             fill="currentColor" class="align-middle pb-1">
                            <polygon
                                    points="207.093,30.187 176.907,0 48.907,128 176.907,256 207.093,225.813 109.28,128"/>
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

            <div class="new-products">
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
    </div>
</aside>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Bootstrap -->
<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>

<!-- Product slider -->
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.new-products').slick({
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
        $(this).parent().parent().parent().find('.new-products').slick('slickPrev');
    });

    $('.carousel-next').click(function (e) {
        e.preventDefault();
        $(this).parent().parent().parent().find('.new-products').slick('slickNext');
    });
</script>

<script src="/template/js/main.js"></script>
<script>

    let logged = 0;

    let saveReview = () => {
        let review = {
            product_id: $("#product_id").val(),
            name: $("#reviewer_name").val(),
            email: $("#reviewer_email").val(),
            text: $("#reviewer_text").val()
        }

        $.post('/api/save-review', {review}, r => {
            let reviews = '';
            r = JSON.parse(r);
            r.map(i => {
                reviews += `<p><strong>${i.name}</strong><br>${i.text}</p>`
            });
            $('#reviews').html(reviews);
        });
    }

    /**
     * Add product to bag
     */
    $("#products").on("click", ".add-to-bag-first", (e) => {
        let element = e.target.closest(".add-to-bag-first");
        let id = $(element).attr("data-id");
        let volume = 1;
        let unit = $(element).attr("data-unit");
        unit = ' ' + unit;
        $(element).get(0).classList.add("d-none");
        $(element).get(0).nextSibling.nextSibling.classList.remove("d-none");
        $(element).get(0).nextSibling.nextSibling.children[1].value = volume + unit;
        $.post('/bag/add', {
            id: id,
            volume: volume
        }, function (r) {
            $("#bag-count").html(r);
        });
        return false;
    });

    /**
     * Add product to bag
     */
    $("#products").on("click", ".add-to-bag-second", (e) => {
        let element = e.target.closest(".add-to-bag-second");
        let id = $(element).attr("data-id");
        let volumeMin = parseFloat($(element).attr("data-volume_min"));
        let volumePrev = $(element).get(0).parentElement.previousSibling.previousSibling.value;
        volumePrev = volumePrev.slice(0, -3);
        volumePrev = parseFloat(volumePrev);
        let volume = Math.round((volumePrev + volumeMin) * 10) / 10;
        let unit = $(element).attr("data-unit");
        unit = ' ' + unit;
        $(element).get(0).parentElement.previousSibling.previousSibling.value = volume + unit;
        $.post('/bag/add', {
            id: id,
            volume: volume
        }, function (r) {
            $("#bag-count").html(r);
        });
        return false;
    });

    /**
     * Remove product from bag
     */
    $("#products").on("click", ".remove-from-bag", (e) => {
        let element = e.target.closest(".remove-from-bag");
        let id = $(element).attr("data-id");
        let volumeMin = parseFloat($(element).attr("data-volume_min"));
        let volumePrev = $(element).get(0).parentElement.nextSibling.nextSibling.value;
        volumePrev = volumePrev.slice(0, -3);
        volumePrev = parseFloat(volumePrev);
        let volume = Math.round((volumePrev - volumeMin) * 10) / 10;
        let unit = $(element).attr("data-unit");
        unit = ' ' + unit;

        $(element).get(0).parentElement.nextSibling.nextSibling.value = volume + unit;

        if (volume < volumeMin) {
            $(element).get(0).parentElement.parentElement.classList.add("d-none");
            $(element).get(0).parentElement.parentElement.previousSibling.previousSibling.classList.remove("d-none");
        }

        $.post('/bag/reduce', {
            id: id,
            volume: volume
        }, function (r) {
            $('#bag-count').html(r);
        });

        return false;
    });

    /**
     * Change products quantity
     */
    $("#products").on("change", ".input-int, .input-float", (e) => {
        let element = e.target.closest(".input-int, .input-float");
        let unit = $(element).attr("data-unit");
        unit = ' ' + unit;
        let volume = $(element).get(0).value;

        if (volume.includes(unit)) {
            volume = volume.slice(0, -3);
        }

        let id = parseInt($(element).attr("data-id"));
        let quantity = parseFloat(volume);
        $(element).get(0).value = quantity + unit;

        if (!quantity) {
            quantity = 0;
            $(element).get(0).parentElement.classList.add("d-none");
            $(element).get(0).parentElement.previousSibling.previousSibling.classList.remove("d-none");
        }

        $.post('/bag/change', {
            id: id,
            quantity: quantity
        }, function (r) {
            $('#bag-count').html(r);
        });
    });

    $("#products").on("mouseenter", ".product-card", (e) => {
            $(e.target.closest(".product-card")).find('.add-to-bag-first').removeClass('invisible');
            // $(e.target.closest(".product-card")).find('.like').removeClass('invisible');
        }
    );

    $("#products").on("mouseleave", ".product-card", (e) => {
            $(e.target.closest(".product-card")).find('.add-to-bag-first').addClass('invisible');
            // if (!likes.includes($(e.target.closest(".product-card")).attr('data-id')))
            //     $(e.target.closest(".product-card")).find('.like').addClass('invisible');
        }
    );

    $.get('/bag/list', {}, function (r) {
        if (r) {
            r = JSON.parse(r);
            $("a[data-id]").each(function (i) {
                for (const p in r) {
                    if (parseInt($(this).attr("data-id")) === parseInt(p)) {
                        if (r[p] > 0) {
                            $(this).get(0).classList.add("d-none");
                            let inputGroup = $(this).get(0).nextSibling.nextSibling;
                            inputGroup.classList.remove("d-none");
                            let unit = $(this).attr("data-unit");
                            inputGroup.children[1].value = r[p] + ' ' + unit;
                        }
                    }
                }
            });
        }
    });

    $(".product-index-search").keyup(function () {
        $.post('/search', {
            search_term: $(this).val(),
            user_id: $(this).attr("data-user-id")
        }, function (r) {
            $('.pager').remove();
            let products = '';
            JSON.parse(r).map(i => {
                let price = parseFloat(i.price)
                let currency = parseFloat(i.currency) || 0
                let percent = parseFloat(i.percent) || 0
                let discount = currency + (price / 100 * percent)

                products += `
                <div class="col-6 col-md-3 pl-1 pr-1 pb-2 product-card" data-id="${i.id}">
                    <div class="card h-100">
                        <button class="btn btn-outline-primary border-0 btn-sm position-absolute float-right m-2 invisible like"
                                style="right: 0;z-index: 1;" data-id="${i.id}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 456" height="1.3em" fill="currentColor" class="align-middle pb-1">
                                <path d="m471.382812 44.578125c-26.503906-28.746094-62.871093-44.578125-102.410156-44.578125-29.554687 0-56.621094 9.34375-80.449218 27.769531-12.023438 9.300781-22.917969 20.679688-32.523438 33.960938-9.601562-13.277344-20.5-24.660157-32.527344-33.960938-23.824218-18.425781-50.890625-27.769531-80.445312-27.769531-39.539063 0-75.910156 15.832031-102.414063 44.578125-26.1875 28.410156-40.613281 67.222656-40.613281 109.292969 0 43.300781 16.136719 82.9375 50.78125 124.742187 30.992188 37.394531 75.535156 75.355469 127.117188 119.3125 17.613281 15.011719 37.578124 32.027344 58.308593 50.152344 5.476563 4.796875 12.503907 7.4375 19.792969 7.4375 7.285156 0 14.316406-2.640625 19.785156-7.429687 20.730469-18.128907 40.707032-35.152344 58.328125-50.171876 51.574219-43.949218 96.117188-81.90625 127.109375-119.304687 34.644532-41.800781 50.777344-81.4375 50.777344-124.742187 0-42.066407-14.425781-80.878907-40.617188-109.289063zm0 0"/>
                            </svg>
                        </button>
                        <div class="px-4 pt-4">
                            <a href="/product/${i.slug}">
                                <img class="card-img-top" src="/template/images/${i.image}" alt="${i.title}">
                            </a>
                        </div>

                        <div class="card-body d-flex flex-column justify-content-between p-3">
                            <a href="#" class="add-to-bag-first btn btn-outline-primary btn-sm invisible" data-id="${i.id}" data-unit="${i.unit}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="1.3em" fill="currentColor" class="align-middle pb-1">
                                    <path d="M447.988,139.696c-0.156-2.084-1.9-3.696-3.988-3.696h-72v-20C372,52.036,319.96,0,256,0S140,52.036,140,116v20H68    c-2.088,0-3.832,1.612-3.988,3.696l-28,368c-0.084,1.108,0.296,2.204,1.056,3.02C37.824,511.536,38.888,512,40,512h432    c1.112,0,2.176-0.464,2.932-1.28c0.756-0.816,1.14-1.912,1.056-3.02L447.988,139.696z M172,116c0-46.316,37.68-84,84-84    s84,37.684,84,84v20H172V116z M156,248c-22.06,0-40-17.944-40-40c0-15.964,8-30.348,24-36.66V208c0,8.824,7.18,16,16,16    s16-7.176,16-16v-36.636c16,6.312,24,20.804,24,36.636C196,230.056,178.06,248,156,248z M356,248c-22.06,0-40-17.944-40-40    c0-15.964,8-30.348,24-36.66V208c0,8.824,7.18,16,16,16s16-7.176,16-16v-36.636c16,6.312,24,20.804,24,36.636    C396,230.056,378.06,248,356,248z"/>
                                </svg>
                            </a>

                            <div class="input-group input-group-sm d-none">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-outline-primary remove-from-bag" data-id="${i.id}" data-volume_min="${i.volume_min}" data-unit="${i.unit}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 459 459" height="0.6em" fill="currentColor" class="align-middle">
                                            <path d="M459.313,229.648c0,22.201-17.992,40.199-40.205,40.199H40.181c-11.094,0-21.14-4.498-28.416-11.774   C4.495,250.808,0,240.76,0,229.66c-0.006-22.204,17.992-40.199,40.202-40.193h378.936   C441.333,189.472,459.308,207.456,459.313,229.648z"/>
                                        </svg>
                                    </button>
                                </div>

                                <input type="text" class="form-control text-center ${i.unit == 'шт' ? 'input-int' : 'input-float'}" data-id="${i.id}" data-unit="${i.unit}">

                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-primary add-to-bag-second" data-id="${i.id}" data-volume_min="${i.volume_min}" data-unit="${i.unit}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 448" height="0.8em" fill="currentColor" class="align-middle">
                                            <path d="m408 184h-136c-4.417969 0-8-3.582031-8-8v-136c0-22.089844-17.910156-40-40-40s-40 17.910156-40 40v136c0 4.417969-3.582031 8-8 8h-136c-22.089844 0-40 17.910156-40 40s17.910156 40 40 40h136c4.417969 0 8 3.582031 8 8v136c0 22.089844 17.910156 40 40 40s40-17.910156 40-40v-136c0-4.417969 3.582031-8 8-8h136c22.089844 0 40-17.910156 40-40s-17.910156-40-40-40zm0 0"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <p class="card-text pt-2" style="min-height: 48px;">${i.title}</p>

                            <div class="d-flex justify-content-between align-items-end">${i.volume} ${i.unit}
                                <div>
                                    <div><strike>${(i.currency + (i.price / 100 * i.percent)) > 0 ? new Intl.NumberFormat('uk-UA', {
                    style: 'decimal',
                    minimumFractionDigits: 2
                }).format(price) + ' ₴' : ''}</strike></div>
                                    <div><strong>${new Intl.NumberFormat('uk-UA', {
                    style: 'decimal',
                    minimumFractionDigits: 2
                }).format(price - discount) + ' ₴'}</strong></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                `
            })
            $('#products').html(products);
        })
    });
</script>

<?php include_once ROOT . '/views/layouts/footer.php' ?>

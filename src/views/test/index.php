<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
</head>
<body>
<?php
$file = "{$product['slug']}.html";
$current = file_get_contents($file);
$current .= "
<!doctype html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta content='width=device-width, initial-scale=1, shrink-to-fit=no' name='viewport'>
    <meta content='' name='description'>
    <meta content='' name='author'>
    <link href='favicon.svg' rel='icon' type='image/svg+xml'>

    <title>Вітамін+</title>

    <link href='https://getbootstrap.com/docs/4.0/examples/navbar-fixed/' rel='canonical'>

    <!-- Bootstrap core CSS -->
    <link href='template/css/bootstrap.min.css' rel='stylesheet'>

    <!-- Custom styles for this template -->
    <link href='template/css/public.css' rel='stylesheet'>
</head>

<body style='background-color: #f5f5f5;'>

<header class='fixed-top bg-white text-dark'>
    <div class='d-md-block border-bottom px-3 py-2'>
        <div class='container-fluid'>
            <div class='d-flex justify-content-between'>
                <span class='text-muted'>
                    <a class='btn btn-light btn-sm text-muted' href='tel:+380663100015'>
                        <svg class='align-middle pb-1' fill='currentColor' height='1.4em' viewBox='0 0 384 384'
                             xmlns='http://www.w3.org/2000/svg'>
                            <path d='M353.188,252.052c-23.51,0-46.594-3.677-68.469-10.906c-10.719-3.656-23.896-0.302-30.438,6.417l-43.177,32.594    c-50.073-26.729-80.917-57.563-107.281-107.26l31.635-42.052c8.219-8.208,11.167-20.198,7.635-31.448    c-7.26-21.99-10.948-45.063-10.948-68.583C132.146,13.823,118.323,0,101.333,0H30.813C13.823,0,0,13.823,0,30.813    C0,225.563,158.438,384,353.188,384c16.99,0,30.813-13.823,30.813-30.813v-70.323C384,265.875,370.177,252.052,353.188,252.052z'/>
                        </svg>
                        +38 (066) 31 000 15
                    </a>
                </span>
                <span>
                    <a class='btn btn-light btn-sm text-muted' href='/cabinet/history'>
                        <svg class='align-middle pb-1' fill='currentColor' height='1.4em'
                             viewBox='0 30 515 455' xmlns='http://www.w3.org/2000/svg'>
                            <path d='m290 32.222c-113.405 0-207.262 84.222-222.981 193.333h-67.019l96.667 96.667 96.667-96.667h-61.188c14.972-73.444 80.056-128.889 157.854-128.889 88.832 0 161.111 72.28 161.111 161.111s-72.279 161.112-161.111 161.112c-51.684 0-100.6-25.079-130.84-67.056l-52.298 37.635c42.323 58.78 110.78 93.866 183.138 93.866 124.373 0 225.556-101.198 225.556-225.556s-101.183-225.556-225.556-225.556z'/>
                            <path d='m257.778 161.111v131.029l96.195 57.711 33.166-55.256-64.917-38.956v-94.527z'/>
                        </svg>
                    </a>
                    <a class='btn btn-light btn-sm text-muted' href='/bag'>
                        <svg class='align-middle pb-1' fill='currentColor' height='1.5em'
                             viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'><path
                                d='M447.988,139.696c-0.156-2.084-1.9-3.696-3.988-3.696h-72v-20C372,52.036,319.96,0,256,0S140,52.036,140,116v20H68    c-2.088,0-3.832,1.612-3.988,3.696l-28,368c-0.084,1.108,0.296,2.204,1.056,3.02C37.824,511.536,38.888,512,40,512h432    c1.112,0,2.176-0.464,2.932-1.28c0.756-0.816,1.14-1.912,1.056-3.02L447.988,139.696z M172,116c0-46.316,37.68-84,84-84    s84,37.684,84,84v20H172V116z M156,248c-22.06,0-40-17.944-40-40c0-15.964,8-30.348,24-36.66V208c0,8.824,7.18,16,16,16    s16-7.176,16-16v-36.636c16,6.312,24,20.804,24,36.636C196,230.056,178.06,248,156,248z M356,248c-22.06,0-40-17.944-40-40    c0-15.964,8-30.348,24-36.66V208c0,8.824,7.18,16,16,16s16-7.176,16-16v-36.636c16,6.312,24,20.804,24,36.636    C396,230.056,378.06,248,356,248z'/></svg>
                        <span class='badge badge-pill badge-danger' id='bag-count'>0</span>
                    </a>
                </span>
            </div>
        </div>
    </div>
    <nav class='navbar navbar-expand-md navbar-light '>
        <div class='container-fluid'>
            <a class='navbar-brand mb-1' href='/'>
                <img alt='' height='29' src='template/images/logo.jpg'>
            </a>
            <button aria-controls='navbarCollapse' aria-expanded='false' aria-label='Toggle navigation' class='navbar-toggler'
                    data-target='#navbarCollapse' data-toggle='collapse' type='button'>
                <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse' id='navbarCollapse'>
                <ul class='navbar-nav mr-auto'></ul>
                <form class='form-inline mt-5 mt-md-0'>
                    <a class='btn btn-outline-primary mr-1' href='/signin'>
                        <svg class='align-middle pb-1' fill='currentColor' height='1.2em'
                             viewBox='0 0 515.556 515.556' xmlns='http://www.w3.org/2000/svg'>
                            <path d='m96.667 0v96.667h64.444v-32.223h257.778v386.667h-257.778v-32.222h-64.444v96.667h386.667v-515.556z'/>
                            <path d='m157.209 331.663 45.564 45.564 119.449-119.449-119.448-119.449-45.564 45.564 41.662 41.662h-166.65v64.445h166.65z'/>
                        </svg>
                        Вхід
                    </a>
                    <a class='btn btn-primary' href='/signup'>
                        <svg class='align-middle pb-1' fill='currentColor' height='1.2em'
                             viewBox='0 30 512 450' xmlns='http://www.w3.org/2000/svg'>
                            <path d='m431.964 435.333c-.921-58.994-19.3-112.636-51.977-151.474-32.487-38.601-76.515-59.859-123.987-59.859s-91.5 21.258-123.987 59.859c-32.646 38.797-51.013 92.364-51.973 151.285 18.46 9.247 94.85 44.856 175.96 44.856 87.708 0 158.845-35.4 175.964-44.667z'/>
                            <circle cx='256' cy='120' r='88'/>
                        </svg>
                        Реєстрація
                    </a>
                </form>
            </div>
        </div>
    </nav>
</header>

<main class='content container-fluid px-4' role='main' style='margin-top: 120px;'>
    <div class='row'>
        <aside class='container-fluid'>
            <div class='row' id='products'>
                <div class='col-md-12 col-xl-8 offset-xl-2 p-1'>
                    <nav aria-label='breadcrumb' class='card'>
                        <ol class='breadcrumb m-0' style='background-color: rgba(255, 255, 128, .0)'>
                            <li class='breadcrumb-item'><a href='/'>Головна</a></li>
                            <li class='breadcrumb-item'><a href='#'>Сухофрукти</a></li>
                            <li aria-current='page' class='breadcrumb-item active'>Ягоди Годжі</li>
                        </ol>
                    </nav>
                </div>

                <div class='col-md-6 col-xl-4 offset-xl-2 p-1'>
                    <div class='card h-100'>
                        <div class='card-body d-flex align-items-center'>
                            <img alt='Ягоди Годжі' class='align-middle mx-auto d-block img-fluid'
                                 src='template/images/d91dcea3.jpg'>
                        </div>
                    </div>
                </div>

                <div class='col-md-6 col-xl-4 p-1'>
                    <div class='card'>
                        <div class='card-body'>
                            <p class='text-muted'><small><strong>Код товару: d91dcea3</strong></small></p>
                            <h1 class='card-title'><strong>Ягоди Годж</strong></h1>
                            <p class='text-muted'>
                                <small>Ціна за 1 кг</small><br>
                                <small>Мін. замовлення 0.1 кг</small>
                            </p>

                            <div>
                                <div class='h1'>
                                    315,00 ₴
                                </div>

                                <div class='d-flex flex-column justify-content-between'>
                                    <a class='add-to-bag-first btn btn-outline-primary' data-id='213' data-unit='кг'
                                       href='#'>
                                        <svg class='align-middle pb-1' fill='currentColor' height='1.3em'
                                             viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'>
                                            <path d='M447.988,139.696c-0.156-2.084-1.9-3.696-3.988-3.696h-72v-20C372,52.036,319.96,0,256,0S140,52.036,140,116v20H68    c-2.088,0-3.832,1.612-3.988,3.696l-28,368c-0.084,1.108,0.296,2.204,1.056,3.02C37.824,511.536,38.888,512,40,512h432    c1.112,0,2.176-0.464,2.932-1.28c0.756-0.816,1.14-1.912,1.056-3.02L447.988,139.696z M172,116c0-46.316,37.68-84,84-84    s84,37.684,84,84v20H172V116z M156,248c-22.06,0-40-17.944-40-40c0-15.964,8-30.348,24-36.66V208c0,8.824,7.18,16,16,16    s16-7.176,16-16v-36.636c16,6.312,24,20.804,24,36.636C196,230.056,178.06,248,156,248z M356,248c-22.06,0-40-17.944-40-40    c0-15.964,8-30.348,24-36.66V208c0,8.824,7.18,16,16,16s16-7.176,16-16v-36.636c16,6.312,24,20.804,24,36.636    C396,230.056,378.06,248,356,248z'/>
                                        </svg>

                                        Покласти в кошик
                                    </a>

                                    <div class='input-group d-none'>
                                        <div class='input-group-prepend'>
                                            <button class='btn btn-outline-primary remove-from-bag' data-id='213'
                                                    data-unit='кг'
                                                    data-volume_min='0.1' type='button'>
                                                <svg class='align-middle' fill='currentColor'
                                                     height='0.6em'
                                                     viewBox='0 0 459 459' xmlns='http://www.w3.org/2000/svg'>
                                                    <path d='M459.313,229.648c0,22.201-17.992,40.199-40.205,40.199H40.181c-11.094,0-21.14-4.498-28.416-11.774   C4.495,250.808,0,240.76,0,229.66c-0.006-22.204,17.992-40.199,40.202-40.193h378.936   C441.333,189.472,459.308,207.456,459.313,229.648z'/>
                                                </svg>
                                            </button>
                                        </div>

                                        <input class='form-control text-center
                                        input-float' data-id='213'
                                               data-unit='кг' type='text'>

                                        <div class='input-group-append'>
                                            <button class='btn btn-outline-primary add-to-bag-second' data-id='213'
                                                    data-unit='кг'
                                                    data-volume_min='0.1' type='button'>
                                                <svg class='align-middle' fill='currentColor'
                                                     height='0.8em' viewBox='0 0 448 448' xmlns='http://www.w3.org/2000/svg'>
                                                    <path d='m408 184h-136c-4.417969 0-8-3.582031-8-8v-136c0-22.089844-17.910156-40-40-40s-40 17.910156-40 40v136c0 4.417969-3.582031 8-8 8h-136c-22.089844 0-40 17.910156-40 40s17.910156 40 40 40h136c4.417969 0 8 3.582031 8 8v136c0 22.089844 17.910156 40 40 40s40-17.910156 40-40v-136c0-4.417969 3.582031-8 8-8h136c22.089844 0 40-17.910156 40-40s-17.910156-40-40-40zm0 0'/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='card mt-2'>
                        <div class='card-body'>
                            <h4 class='card-title'>Характеристики</h4>
                            <hr>
                            <ul>
                                <li><strong>Калорійність (на 100г): </strong>600 ккал</li>
                                <li><strong>Умови зберігання: </strong>температура 0 до +10; вологість до 70%</li>
                                <li><strong>Термін зберігання: </strong>6 місяців</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class='col-md-6 col-xl-4 offset-xl-2 p-1'>
                    <div class='card'>
                        <div class='card-body'>
                            <h4 class='card-title'>Корисна інформація</h4>
                            <hr>
                            <p class='card-text'>
                            <p>Плоди годжі мають довгасту форму і червоний колір. Вони містять цинк, йод, селен, залізо,
                                кальцій, фосфор, калій, германій, магній, мідь, кобальт, вітаміни А, С, В1, В2, В6, В9,
                                Е. Тобто завдяки широкому спектру необхідних людині мікроелементів і вітамінів ягоди
                                годжі підвищують тонус, дають заряд енергії, нормалізують роботу нервової системи,
                                покращують зір, підвищують рівень гемоглобіну у крові.</p>

                            <p>Лінолева кислота, що міститься у плодах годжі, спалює жир, тому дієтологи часто додають
                                їх у раціон дієтичного харчування. Ці плоди підтримують баланс мікрофлори кишківника,
                                очищають печінку, виводять зайву рідину з організму.</p>

                            <p>Оскільки продукти містять кислоти Омега-6, Омега-3 і полісахариди LBP, годжі нормалізують
                                гормональний фон і мають антиоксидантну дію, підтримуючи молодість клітин і стимулюючи
                                їх оновлення.</p></p>
                        </div>
                    </div>
                </div>

                <div class='col-md-6 col-xl-4 p-1'>
                    <div class='card'>
                        <div class='card-body'>
                            <div class='d-flex justify-content-between'>
                                <h4 class='card-title mb-0'>Відгуки</h4>
                                <button class='btn btn-sm btn-link' data-target='#productReview' data-toggle='modal'
                                        type='button'>Написати
                                </button>
                                <div aria-hidden='true' class='modal fade' id='productReview' role='dialog'
                                     tabindex='-1'>
                                    <div class='modal-dialog' role='document'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title'>Ваш відгук</h5>
                                                <button aria-label='Close' class='close' data-dismiss='modal'
                                                        type='button'>
                                                    <span aria-hidden='true'>&times;</span>
                                                </button>
                                            </div>
                                            <div class='modal-body'>
                                                <form>
                                                    <input class='d-none' id='product_id' type='text' value='213'>
                                                    <div class='form-group'>
                                                        <label for='reviewer_name'>Ім'я</label>
                                                        <input class='form-control' id='reviewer_name' placeholder='Ваше ім'я'
                                                               type='text'>
                                                    </div>
                                                    <div class='form-group'>
                                                        <label for='reviewer_email'>Електронна пошта</label>
                                                        <input class='form-control' id='reviewer_email' placeholder='name@example.com'
                                                               type='email'>
                                                    </div>
                                                    <div class='form-group'>
                                                        <label for='reviewer_text'>Відгук</label>
                                                        <textarea class='form-control' id='reviewer_text' placeholder='Ваш відгук'
                                                                  rows='3'></textarea>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class='modal-footer'>
                                                <button class='btn btn-secondary' data-dismiss='modal' type='button'>
                                                    Відміна
                                                </button>
                                                <button class='btn btn-primary' data-dismiss='modal' onclick='saveReview()'
                                                        type='button'>Зберегти
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <p><strong>Іван</strong><br>Дуже хороший товар, добре заходить з пивком під футбольчик</p>
                            <p><strong>Петро</strong><br>Люблю сидіти під дверима і лускати соняшки</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- jQuery -->
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>

        <!-- Bootstrap -->
        <script src='https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js'></script>
        <script src='https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js'></script>

        <script src='/template/js/main.js'></script>
        <script>

            // let likes = [];
            let logged = 0;

            let saveReview = () => {
                let review = {
                    product_id: $('#product_id').val(),
                    name: $('#reviewer_name').val(),
                    email: $('#reviewer_email').val(),
                    text: $('#reviewer_text').val()
                }

                $.post('/api/save-review', {review}, r => console.log(r));
            }

            /**
             * Add product to bag
             */
            $('#products').on('click', '.add-to-bag-first', (e) => {
                let element = e.target.closest('.add-to-bag-first');
                let id = $(element).attr('data-id');
                let volume = 1;
                let unit = $(element).attr('data-unit');
                unit = ' ' + unit;
                $(element).get(0).classList.add('d-none');
                $(element).get(0).nextSibling.nextSibling.classList.remove('d-none');
                $(element).get(0).nextSibling.nextSibling.children[1].value = volume + unit;
                $.post('/bag/add', {
                    id: id,
                    volume: volume
                }, function (r) {
                    $('#bag-count').html(r);
                });
                return false;
            });

            /**
             * Add product to bag
             */
            $('#products').on('click', '.add-to-bag-second', (e) => {
                let element = e.target.closest('.add-to-bag-second');
                let id = $(element).attr('data-id');
                let volumeMin = parseFloat($(element).attr('data-volume_min'));
                let volumePrev = $(element).get(0).parentElement.previousSibling.previousSibling.value;
                volumePrev = volumePrev.slice(0, -3);
                volumePrev = parseFloat(volumePrev);
                let volume = Math.round((volumePrev + volumeMin) * 10) / 10;
                let unit = $(element).attr('data-unit');
                unit = ' ' + unit;
                $(element).get(0).parentElement.previousSibling.previousSibling.value = volume + unit;
                $.post('/bag/add', {
                    id: id,
                    volume: volume
                }, function (r) {
                    $('#bag-count').html(r);
                });
                return false;
            });

            /**
             * Remove product from bag
             */
            $('#products').on('click', '.remove-from-bag', (e) => {
                let element = e.target.closest('.remove-from-bag');
                let id = $(element).attr('data-id');
                let volumeMin = parseFloat($(element).attr('data-volume_min'));
                let volumePrev = $(element).get(0).parentElement.nextSibling.nextSibling.value;
                volumePrev = volumePrev.slice(0, -3);
                volumePrev = parseFloat(volumePrev);
                let volume = Math.round((volumePrev - volumeMin) * 10) / 10;
                let unit = $(element).attr('data-unit');
                unit = ' ' + unit;

                $(element).get(0).parentElement.nextSibling.nextSibling.value = volume + unit;

                if (volume < volumeMin) {
                    $(element).get(0).parentElement.parentElement.classList.add('d-none');
                    $(element).get(0).parentElement.parentElement.previousSibling.previousSibling.classList.remove('d-none');
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
            $('#products').on('change', '.input-int, .input-float', (e) => {
                let element = e.target.closest('.input-int, .input-float');
                let unit = $(element).attr('data-unit');
                unit = ' ' + unit;
                let volume = $(element).get(0).value;

                if (volume.includes(unit)) {
                    volume = volume.slice(0, -3);
                }

                let id = parseInt($(element).attr('data-id'));
                let quantity = parseFloat(volume);
                $(element).get(0).value = quantity + unit;

                if (!quantity) {
                    quantity = 0;
                    $(element).get(0).parentElement.classList.add('d-none');
                    $(element).get(0).parentElement.previousSibling.previousSibling.classList.remove('d-none');
                }

                $.post('/bag/change', {
                    id: id,
                    quantity: quantity
                }, function (r) {
                    $('#bag-count').html(r);
                });
            });

            $.get('/bag/list', {}, function (r) {
                if (r) {
                    r = JSON.parse(r);
                    $('a[data-id]').each(function (i) {
                        for (const p in r) {
                            if (parseInt($(this).attr('data-id')) === parseInt(p)) {
                                if (r[p] > 0) {
                                    $(this).get(0).classList.add('d-none');
                                    let inputGroup = $(this).get(0).nextSibling.nextSibling;
                                    inputGroup.classList.remove('d-none');
                                    let unit = $(this).attr('data-unit');
                                    inputGroup.children[1].value = r[p] + ' ' + unit;
                                }
                            }
                        }
                    });
                }
            });
        </script>
    </div>
</main>

<footer class='footer bg-white text-dark'>
    <div class='container-fluid p-3'>
        <span class='text-muted'>&copy; 2020 Вітамін+</span>
    </div>
</footer>
</body>
</html>
";
file_put_contents($file, $current);
?>

</body>
</html>
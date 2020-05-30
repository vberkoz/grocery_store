<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
<!--    <link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">-->
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">

    <title>Вітамін+</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/navbar-fixed/">

    <!-- Bootstrap core CSS -->
    <link href="/template/css/bootstrap.min.css" rel="stylesheet">
<!--    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">-->

    <!-- Custom styles for this template -->
<!--    <link href="https://getbootstrap.com/docs/4.0/examples/navbar-fixed/navbar-top-fixed.css" rel="stylesheet">-->
    <link rel="stylesheet" href="/template/css/public.css">
</head>

<body style="background-color: #f5f5f5;">

<header class="fixed-top bg-white text-dark">
    <div class="d-md-block border-bottom">
        <div class="container">
            <div class="d-flex justify-content-between">
                <span class="text-muted py-2">
                    <a href="tel:+380663100015" class="btn btn-light btn-sm text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 384" height="1.4em" fill="currentColor" class="align-middle pb-1">
                            <path d="M353.188,252.052c-23.51,0-46.594-3.677-68.469-10.906c-10.719-3.656-23.896-0.302-30.438,6.417l-43.177,32.594    c-50.073-26.729-80.917-57.563-107.281-107.26l31.635-42.052c8.219-8.208,11.167-20.198,7.635-31.448    c-7.26-21.99-10.948-45.063-10.948-68.583C132.146,13.823,118.323,0,101.333,0H30.813C13.823,0,0,13.823,0,30.813    C0,225.563,158.438,384,353.188,384c16.99,0,30.813-13.823,30.813-30.813v-70.323C384,265.875,370.177,252.052,353.188,252.052z"/>
                        </svg>
                        Тел: +38 (066) 31 000 15
                    </a>
                </span>
                <span class="py-2">
<!--                    <a href="/cabinet/liked" class="btn btn-light btn-sm text-muted">-->
<!--                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 456" height="1.3em" fill="currentColor" class="align-middle pb-1">-->
<!--                            <path d="m471.382812 44.578125c-26.503906-28.746094-62.871093-44.578125-102.410156-44.578125-29.554687 0-56.621094 9.34375-80.449218 27.769531-12.023438 9.300781-22.917969 20.679688-32.523438 33.960938-9.601562-13.277344-20.5-24.660157-32.527344-33.960938-23.824218-18.425781-50.890625-27.769531-80.445312-27.769531-39.539063 0-75.910156 15.832031-102.414063 44.578125-26.1875 28.410156-40.613281 67.222656-40.613281 109.292969 0 43.300781 16.136719 82.9375 50.78125 124.742187 30.992188 37.394531 75.535156 75.355469 127.117188 119.3125 17.613281 15.011719 37.578124 32.027344 58.308593 50.152344 5.476563 4.796875 12.503907 7.4375 19.792969 7.4375 7.285156 0 14.316406-2.640625 19.785156-7.429687 20.730469-18.128907 40.707032-35.152344 58.328125-50.171876 51.574219-43.949218 96.117188-81.90625 127.109375-119.304687 34.644532-41.800781 50.777344-81.4375 50.777344-124.742187 0-42.066407-14.425781-80.878907-40.617188-109.289063zm0 0"/>-->
<!--                        </svg>-->
<!--                        Список-->
<!--                    </a>-->
                    <a href="/bag" class="btn btn-light btn-sm text-muted">
                        <svg class="align-middle pb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="1.5em" fill="currentColor"><path d="M447.988,139.696c-0.156-2.084-1.9-3.696-3.988-3.696h-72v-20C372,52.036,319.96,0,256,0S140,52.036,140,116v20H68    c-2.088,0-3.832,1.612-3.988,3.696l-28,368c-0.084,1.108,0.296,2.204,1.056,3.02C37.824,511.536,38.888,512,40,512h432    c1.112,0,2.176-0.464,2.932-1.28c0.756-0.816,1.14-1.912,1.056-3.02L447.988,139.696z M172,116c0-46.316,37.68-84,84-84    s84,37.684,84,84v20H172V116z M156,248c-22.06,0-40-17.944-40-40c0-15.964,8-30.348,24-36.66V208c0,8.824,7.18,16,16,16    s16-7.176,16-16v-36.636c16,6.312,24,20.804,24,36.636C196,230.056,178.06,248,156,248z M356,248c-22.06,0-40-17.944-40-40    c0-15.964,8-30.348,24-36.66V208c0,8.824,7.18,16,16,16s16-7.176,16-16v-36.636c16,6.312,24,20.804,24,36.636    C396,230.056,378.06,248,356,248z"/></svg>
                        Кошик <span class="badge badge-pill badge-danger" id="bag-count"><?php echo Bag::countItems(); ?></span>
                    </a>
                </span>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-md navbar-light ">
        <div class="container">
            <a class="navbar-brand mb-1" href="/category/1">
                <img src="/template/images/logo.jpg" height="29" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
<!--                    <li class="nav-item">-->
<!--                        <a class="nav-link" href="/category/1">Магазин <span class="sr-only">(current)</span></a>-->
<!--                    </li>-->
<!--                    <li class="nav-item">-->
<!--                        <a class="nav-link" href="/contact">Зв'язатися</a>-->
<!--                    </li>-->

                    <?php foreach ($categories as $category): ?>
                        <li class="nav-item">
                            <a href="/category/<?php echo $category['id']; ?>"
                               class="nav-link
                                <?php if (isset($categoryId)): ?>
                                    <?php if ($categoryId == $category['id']): ?>
                                        <?php $currentCategoryName = $category['title']; ?>active
                                    <?php endif; ?>
                                <?php endif; ?>
                            ">
                                <?php echo $category['title']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <form class="form-inline mt-2 mt-md-0">
                    <?php if (User::isGuest()): ?>
                        <a class="btn btn-outline-primary mr-1" href="/signin">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 515.556 515.556" height="1.2em" fill="currentColor" class="align-middle pb-1">
                                <path d="m96.667 0v96.667h64.444v-32.223h257.778v386.667h-257.778v-32.222h-64.444v96.667h386.667v-515.556z"/>
                                <path d="m157.209 331.663 45.564 45.564 119.449-119.449-119.448-119.449-45.564 45.564 41.662 41.662h-166.65v64.445h166.65z"/>
                            </svg>
                            Вхід
                        </a>
                        <a class="btn btn-primary" href="/signup">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 30 512 450" height="1.2em" fill="currentColor" class="align-middle pb-1">
                                <path d="m431.964 435.333c-.921-58.994-19.3-112.636-51.977-151.474-32.487-38.601-76.515-59.859-123.987-59.859s-91.5 21.258-123.987 59.859c-32.646 38.797-51.013 92.364-51.973 151.285 18.46 9.247 94.85 44.856 175.96 44.856 87.708 0 158.845-35.4 175.964-44.667z"/>
                                <circle cx="256" cy="120" r="88"/>
                            </svg>
                            Реєстрація
                        </a>
                    <?php else: ?>
                        <a class="btn btn-outline-primary mr-1" href="/signout">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 515 515" height="1.2em" fill="currentColor" class="align-middle pb-1">
                                <path d="m225.556 0h64.444v257.778h-64.444z"/>
                                <path d="m322.222 73.944v68.602c56.798 24.932 96.667 81.559 96.667 147.454 0 88.832-72.28 161.111-161.111 161.111s-161.111-72.279-161.111-161.111c0-65.896 39.869-122.523 96.667-147.454v-68.602c-93.051 27.813-161.112 114.097-161.112 216.056 0 124.358 101.182 225.556 225.556 225.556s225.556-101.198 225.556-225.556c0-101.959-68.061-188.243-161.112-216.056z"/>
                            </svg>
                            Вихід
                        </a>
                        <a class="btn btn-primary" href="/cabinet/history">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 30 512 450" height="1.2em" fill="currentColor" class="align-middle pb-1">
                                <path d="m431.964 435.333c-.921-58.994-19.3-112.636-51.977-151.474-32.487-38.601-76.515-59.859-123.987-59.859s-91.5 21.258-123.987 59.859c-32.646 38.797-51.013 92.364-51.973 151.285 18.46 9.247 94.85 44.856 175.96 44.856 87.708 0 158.845-35.4 175.964-44.667z"/>
                                <circle cx="256" cy="120" r="88"/>
                            </svg>
                            Акаунт
                        </a>
                    <?php endif; ?>
<!--                    <a href="/bag" class="btn btn-outline-secondary mr-1">-->
<!--                        View Bag <span class="badge badge-warning" id="bag-count">--><?php //echo Bag::countItems(); ?><!--</span>-->
<!--                    </a>-->
                </form>
            </div>
        </div>
    </nav>
</header>


<main role="main" class="content container px-4" style="margin-top: 120px;">
    <div class="row">
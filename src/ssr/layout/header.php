<?php

if (isset($pageTitle)) {
    $title = $pageTitle . ' | Вітамін+';
} else {
    $title = 'Вітамін+';
}

return $header = "
<!doctype html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta name='description' content=''>
    <meta name='author' content=''>
    <link rel='icon' type='image/svg+xml' href='/favicon.svg'>

    <title>$title</title>

    <link rel='canonical' href='https://getbootstrap.com/docs/4.0/examples/navbar-fixed/'>

    <!-- Bootstrap core CSS -->
    <link href='$assets/css/bootstrap.min.css' rel='stylesheet'>

    <!-- Custom styles for this template -->
    <link rel='stylesheet' href='$assets/css/public.css'>

    <!-- Product slider -->
    <link rel='stylesheet' type='text/css' href='//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css'/>
    <link rel='stylesheet' type='text/css' href='//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css'/>
</head>

<body style='background-color: #f5f5f5;'>

<header class='fixed-top bg-white text-dark'>
    <div class='d-md-block border-bottom px-3 px-md-0 py-2'>
        <div class='container-fluid px-0 px-md-3'>
            <div class='d-flex justify-content-between'>
                <span class='text-muted'>
                    <a href='tel:+380663100015' class='btn btn-light btn-sm text-muted'>
                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 384 384' height='1.4em' fill='currentColor' class='align-middle pb-1'>
                            <path d='M353.188,252.052c-23.51,0-46.594-3.677-68.469-10.906c-10.719-3.656-23.896-0.302-30.438,6.417l-43.177,32.594    c-50.073-26.729-80.917-57.563-107.281-107.26l31.635-42.052c8.219-8.208,11.167-20.198,7.635-31.448    c-7.26-21.99-10.948-45.063-10.948-68.583C132.146,13.823,118.323,0,101.333,0H30.813C13.823,0,0,13.823,0,30.813    C0,225.563,158.438,384,353.188,384c16.99,0,30.813-13.823,30.813-30.813v-70.323C384,265.875,370.177,252.052,353.188,252.052z'/>
                        </svg>+38 (066) 31 000 15
                    </a>
                </span>
                <ul class='navbar-nav d-none d-md-flex flex-row mr-auto pt-1 pl-2'>
                    <li class='nav-item'><a class='nav-link text-secondary px-2 py-0' href='/public/index.html'>Головна</a></li>
                    <li class='nav-item'><a class='nav-link text-secondary px-2 py-0' href='/public/payment.html'>Оплата і доставка</a></li>
                    <li class='nav-item'><a class='nav-link text-secondary px-2 py-0' href='/public/blog.html'>Блог</a></li>
                    <li class='nav-item'><a class='nav-link text-secondary px-2 py-0' href='/public/contact.html'>Контакти</a></li>
                    <li class='nav-item'><a class='nav-link text-secondary px-2 py-0' href='/public/about.html'>Про нас</a></li>
                </ul>
                <span>
                    <a href='/public/cart.html' class='btn btn-light btn-sm text-muted'>
                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 426.667 426.667' height='1em' fill='currentColor' style='position: relative;'>
                            <path d='M128,341.333c-23.573,0-42.453,19.093-42.453,42.667s18.88,42.667,42.453,42.667c23.573,0,42.667-19.093,42.667-42.667     S151.573,341.333,128,341.333z'/>
                            <path d='M151.467,234.667H310.4c16,0,29.973-8.853,37.333-21.973L424,74.24c1.707-2.987,2.667-6.507,2.667-10.24     c0-11.84-9.6-21.333-21.333-21.333H89.92L69.653,0H0v42.667h42.667L119.36,204.48l-28.8,52.267     c-3.307,6.187-5.227,13.12-5.227,20.587C85.333,300.907,104.427,320,128,320h256v-42.667H137.067     c-2.987,0-5.333-2.347-5.333-5.333c0-0.96,0.213-1.813,0.64-2.56L151.467,234.667z'/>
                            <path d='M341.333,341.333c-23.573,0-42.453,19.093-42.453,42.667s18.88,42.667,42.453,42.667     C364.907,426.667,384,407.573,384,384S364.907,341.333,341.333,341.333z'/>
                        </svg>
                        <span class='badge badge-pill badge-danger d-none' id='cart_count' style='position: relative;top: -3px;'></span>
                    </a>
                </span>
            </div>
        </div>
    </div>
    <nav class='navbar navbar-expand-md navbar-light px-md-0'>
        <div class='container-fluid'>
            <a class='navbar-brand mb-1 d-none d-md-inline-block' href='/public/index.html'>
                <img src='$assets/images/logo.jpg' height='29' alt='Вітамін+'>
            </a>
            <div class='dropdown'>
                <button class='btn btn-outline-primary dropdown-toggle' type='button' id='category_dd' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Категорії</button>
                <div class='dropdown-menu' aria-labelledby='category_dd' id='nav_categories'></div>
            </div>
            <div class='dropdown'>
                <input type='search' class='form-control mx-2 dropdown-toggle' placeholder='Пошук' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' autocomplete='off' onkeyup='search(this)' id='search_input'>
                <div class='dropdown-menu mx-2' aria-labelledby='search' id='search'></div>
            </div>
            <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarCollapse' aria-controls='navbarCollapse' aria-expanded='false' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse' id='navbarCollapse'>
                <ul class='navbar-nav mr-auto pt-4'>
                    <li class='nav-item d-md-none'><a class='nav-link text-secondary' href='/public/index.html'>Головна</a></li>
                    <li class='nav-item d-md-none'><a class='nav-link text-secondary' href='/public/payment.html'>Оплата і доставка</a></li>
                    <li class='nav-item d-md-none'><a class='nav-link text-secondary' href='/public/blog.html'>Блог</a></li>
                    <li class='nav-item d-md-none'><a class='nav-link text-secondary' href='/public/contact.html'>Контакти</a></li>
                    <li class='nav-item d-md-none'><a class='nav-link text-secondary' href='/public/about.html'>Про нас</a></li>
                </ul>
                <form class='form-inline mt-5 mt-md-0'>
                    <a class='btn btn-primary' href='#'>
                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 30 512 450' height='1.2em' fill='currentColor' class='align-middle pb-1'>
                            <path d='m431.964 435.333c-.921-58.994-19.3-112.636-51.977-151.474-32.487-38.601-76.515-59.859-123.987-59.859s-91.5 21.258-123.987 59.859c-32.646 38.797-51.013 92.364-51.973 151.285 18.46 9.247 94.85 44.856 175.96 44.856 87.708 0 158.845-35.4 175.964-44.667z'/>
                            <circle cx='256' cy='120' r='88'/>
                        </svg>
                    </a>
                </form>
            </div>
        </div>
    </nav>
</header>
";
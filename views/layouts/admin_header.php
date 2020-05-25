<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">

    <title>Керування</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/navbar-fixed/">
    <link href="/template/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/template/css/public.css">
</head>

<body style="background-color: #f5f5f5;">

<header class="fixed-top bg-white text-dark">
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="/admin/product"
                           class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/admin/product') echo 'active'; ?>">
                            Товари <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/category"
                           class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/admin/category') echo 'active'; ?>">
                            Категорії
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/order"
                           class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/admin/order') echo 'active'; ?>">
                            Замовлення
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/user"
                           class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/admin/user') echo 'active'; ?>">
                            Користувачі
                        </a>
                    </li>
                </ul>

                <a class="btn btn-outline-primary mr-1" href="/signout">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 515 515" height="1.2em" fill="currentColor" class="align-middle pb-1">
                        <path d="m225.556 0h64.444v257.778h-64.444z"/>
                        <path d="m322.222 73.944v68.602c56.798 24.932 96.667 81.559 96.667 147.454 0 88.832-72.28 161.111-161.111 161.111s-161.111-72.279-161.111-161.111c0-65.896 39.869-122.523 96.667-147.454v-68.602c-93.051 27.813-161.112 114.097-161.112 216.056 0 124.358 101.182 225.556 225.556 225.556s225.556-101.198 225.556-225.556c0-101.959-68.061-188.243-161.112-216.056z"/>
                    </svg>
                    Вихід
                </a>
            </div>
        </div>
    </nav>
</header>


<main role="main" class="content container" style="margin-top: 70px;">
    <div class="row">
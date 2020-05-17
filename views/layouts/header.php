<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">

    <title>My Jacket</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/navbar-fixed/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/navbar-fixed/navbar-top-fixed.css" rel="stylesheet">
<!--    <link rel="stylesheet" href="/template/css/main.css">-->
</head>

<body style="background-color: #f5f5f5;">

<nav class="navbar navbar-expand-md fixed-top navbar-light bg-light">
    <a class="navbar-brand" href="/category/1">My Jacket</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/category/1">Shop <span class="sr-only">(current)</span></a>
            </li>
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="/posts">Posts</a>-->
<!--            </li>-->
            <li class="nav-item">
                <a class="nav-link" href="/contact">Contact</a>
            </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0">
<!--            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">-->
<!--            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
            <?php if (User::isGuest()): ?>
                <a class="btn btn-outline-primary mr-1" href="/signin">Sign in</a>
                <a class="btn btn-primary mr-1" href="/signup">Sign up</a>
            <?php else: ?>
                <a class="btn btn-outline-primary mr-1" href="/signout">Sign Out</a>
                <a class="btn btn-primary mr-1" href="/cabinet/history">Cabinet</a>
            <?php endif; ?>
            <a href="/bag" class="btn btn-outline-secondary mr-1">
                View Bag <span class="badge badge-warning" id="bag-count"><?php echo Bag::countItems(); ?></span>
            </a>
        </form>
    </div>
</nav>

<main role="main" class="container">
    <div class="row">
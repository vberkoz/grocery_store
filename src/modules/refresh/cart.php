<?php

return "
<main role='main' class='content container px-4' style='margin-top: 120px;'>
<div class='row'>
<div class='col-lg-9 mb-3 p-2'>
    <div class='card'>
        <div class='card-body' id='cart'></div>
    </div>
</div>
<div class='col-lg-3 mb-3 p-2'>
    <div class='card'>
        <div class='card-body'>
            <div class='d-flex justify-content-between m-0'>
                <p class='m-0'>Товари:</p>
                <p class='m-0' id='cart_price'></p>
            </div>
            <div class='d-flex justify-content-between m-0'>
                <p class='m-0'>Знижка:</p>
                <p class='m-0 text-danger' id='cart_discount'></p>
            </div>
            <div class='d-flex justify-content-between m-0'>
                <p class='m-0'>Всього:</p>
                <p class='m-0'><b id='cart_total'></b></p>
            </div>
            <hr>
            <a href='$dir/checkout.html' class='btn btn-primary btn-block'>Замовити</a>
        </div>
    </div>
</div>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js'></script>
<script src='https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js'></script>
<script src='$assets/js/main.js'></script>
<script src='$assets/js/categories.js'></script>
<script src='$assets/js/search.js'></script>  
<script src='$assets/js/cart.js'></script>
";

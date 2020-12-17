<?php

return "
<main role='main' class='content container px-4' style='margin-top: 120px;'>
<div class='row'>
<div class='col-md-12 mb-3' id='info_container'>
    <div class='card'>
        <div class='card-body'>
            <h4 class='card-title'>$yourOrderCap</h4>
            <p class='card-subtitle mb-4 text-success' id='summary'></p>
            <div class='alert alert-warning' role='alert'>$warnCap</div>
            <div class='alert alert-info' role='alert'>$infoCap</div>
            <div class='alert alert-light' role='alert'>$helpCap</div>
            <hr>
            <div class='form-row'>
                <div class='form-group col-md-4'>
                    <label for='name'>$nameCap</label>
                    <input type='text' class='form-control' id='name' placeholder='$nameCap' onblur='validate(this)'>
                    <div class='invalid-feedback'>$m2Cap</div>
                </div>
                <div class='form-group col-md-4'>
                    <label for='phone'>$phoneCap</label>
                    <input type='text' class='form-control' id='phone' placeholder='0661234567' onblur='validate(this)'>
                    <div class='invalid-feedback'>$m10Cap</div>
                </div>
                <div class='form-group col-md-4'>
                    <label for='address'>$addressCap</label>
                    <input type='text' class='form-control' id='address' placeholder='$addressCap' onblur='store(this)'>
                </div>
            </div>
            <div class='form-group'>
                <label for='message'>$msgCap</label>
                <textarea class='form-control' id='message' rows='3' onblur='store(this)'></textarea>
                <small class='form-text text-muted'>$privacyCap</small>
            </div>
            <button type='button' class='btn btn-primary' id='checkout' onclick='checkout()'>$makeCap</button>
        </div>
    </div>
</div>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js'></script>
<script src='https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js'></script>
<script src='$assets/js/main.js'></script>
<script src='$assets/js/categories.js'></script>
<script src='$assets/js/search.js'></script>
<script src='$assets/js/validation.js'></script>
<script src='$assets/js/checkout.js'></script>
";

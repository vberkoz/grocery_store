<?php

$tobecopied = 'http://stage.kl.com.ua/' . $_GET['file'];
$target = $_SERVER['DOCUMENT_ROOT'] . '/' . $_GET['file'];

if (copy($tobecopied, $target)) {
    echo 'File copied successfully';
}else{
    echo 'File could not be copied';
}

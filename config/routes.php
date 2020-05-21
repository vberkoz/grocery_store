<?php

return array(
    'product/([0-9]+)/([0-9]+)' => 'product/show/$1/$2',

    'category/([0-9]+)/page-([0-9]+)' => 'product/index/$1/$2',
    'category/([0-9]+)' => 'product/index/$1',

    'posts' => 'post/index',
    'post/([0-9]+)' => 'post/single/$1',

    'bag/add/([0-9]+)' => 'bag/add/$1',
    'bag/add-ajax/([0-9]+)' => 'bag/addajax/$1',
    'bag/remove-ajax/([0-9]+)' => 'bag/removeajax/$1',
    'bag/change-ajax/([0-9]+)' => 'bag/changeajax/$1',
    'bag/index-ajax' => 'bag/indexajax',
    'bag/checkout' => 'bag/checkout',
    'bag/remove/([0-9]+)' => 'bag/remove/$1',
    'bag/data' => 'bag/data',
    'bag' => 'bag/index',

    'signup' => 'user/signup',
    'signin' => 'user/signin',
    'signout' => 'user/signout',

    'cabinet/history' => 'cabinet/history',
    'cabinet/liked' => 'cabinet/liked',
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',

    'contact' => 'site/contact',
    'about' => 'site/about',

    'admin/product/create' => 'adminProduct/create',
    'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
    'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
    'admin/product' => 'adminProduct/index',

    'admin/category/create' => 'adminCategory/create',
    'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
    'admin/category' => 'adminCategory/index',

    'admin/order/create' => 'adminOrder/create',
    'admin/order/view/([0-9]+)' => 'adminOrder/view/$1',
    'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1',
    'admin/order' => 'adminOrder/index',

    'admin' => 'admin/index',

//    '' => 'product/index/1',
    '' => 'site/index',
);
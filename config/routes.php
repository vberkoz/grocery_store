<?php

return array(
    'category/([0-9]+)/page-([0-9]+)' => 'product/index/$1/$2',
    'category/([0-9]+)' => 'product/index/$1',

    'bag/add' => 'bag/add',
    'bag/reduce' => 'bag/reduce',
    'bag/change' => 'bag/change',
    'bag/list' => 'bag/list',
    'bag/checkout' => 'bag/checkout',
    'bag/remove/([0-9]+)' => 'bag/remove/$1',
    'bag/data' => 'bag/data',
    'bag' => 'bag/index',

    'signup' => 'user/signup',
    'signin' => 'user/signin',
    'signout' => 'user/signout',
    'forgot' => 'user/forgot',
    'change-secret/*' => 'user/changeSecret/$1',

    'cabinet/history' => 'cabinet/history',
    'cabinet/liked' => 'cabinet/liked',
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',

    'likes/add' => 'like/add',
    'likes/remove' => 'like/remove',
    'likes' => 'like/products',

    'contact' => 'site/contact',
    'about' => 'site/about',

    'admin/product/create' => 'adminProduct/create',
    'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
    'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
    'admin/product/([0-9]+)/page-([0-9]+)' => 'adminProduct/index/$1/$2',
    'admin/product/([0-9]+)' => 'adminProduct/index/$1',

    'admin/category/create' => 'adminCategory/create',
    'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
    'admin/category' => 'adminCategory/index',

    'admin/order/create' => 'adminOrder/create',
    'admin/order/view/([0-9]+)' => 'adminOrder/view/$1',
    'admin/order/today' => 'adminOrder/today',
    'admin/order/all' => 'adminOrder/all',
    'admin/order' => 'adminOrder/index',

    'admin/user/view/([0-9]+)/([0-9]+)' => 'adminUser/view/$1/$2',
    'admin/user/view/([0-9]+)/([0-9]+)/page-([0-9]+)' => 'adminUser/view/$1/$2/$3',
    'admin/user/update' => 'adminUser/update',
    'admin/user/restaurant' => 'adminUser/restaurant',
    'admin/user' => 'adminUser/index',

    'admin/discount/index' => 'adminDiscount/index',
    'admin/discount/update' => 'adminDiscount/update',

    '' => 'site/index',
);
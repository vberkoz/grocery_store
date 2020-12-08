<?php

return array(

    /**
     * Dev routes
     */
    'ftp' => 'dev/ftp',
//    'title-to-slug' => 'dev/titleToSlug',
//    'populate-product-details' => 'dev/populateProductDetails',

    /**
     * Public routes
     */
//    'category/([0-9]+)/page-([0-9]+)' => 'product/index/$1/$2',
//    'category/([0-9]+)' => 'product/index/$1',

//    'category/([a-z0-9]+(?:-[a-z0-9]+)*)' => 'product/index/$1',
    'product/([a-z0-9]+(?:-[a-z0-9]+)*)' => 'product/show/$1',
    'search' => 'product/search',

    'api/save-review' => 'review/save',

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

    'cabinet/order/update' => 'cabinet/orderUpdate',
    'cabinet/order/remove' => 'cabinet/orderRemove',
    'cabinet/order/copy' => 'cabinet/orderCopy',
    'cabinet/order/product/add' => 'cabinet/orderProductAdd',
    'cabinet/orders' => 'cabinet/orders',
    'cabinet/history' => 'cabinet/history',
    'cabinet/liked' => 'cabinet/liked',
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',

    'contact' => 'site/contact',
    'about' => 'site/about',

    /**
     * Admin routes
     */
    'admin/commodity/create' => 'adminProduct/create',
    'admin/commodity/update/([0-9]+)' => 'adminProduct/update/$1',
    'admin/commodity/delete/([0-9]+)' => 'adminProduct/delete/$1',
    'admin/commodity/([0-9]+)/page-([0-9]+)' => 'adminProduct/index/$1/$2',
    'admin/commodity/([0-9]+)' => 'adminProduct/index/$1',

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
    'admin/discount/currency' => 'adminDiscount/currency',
    'admin/discount/percent' => 'adminDiscount/percent',

    '' => 'site/index',
);

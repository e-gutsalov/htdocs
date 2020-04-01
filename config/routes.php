<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 10-Feb-19
 * Time: 01:32
 */

return

[
    '' => 'main/main',
    //'download' => 'download/download',
    'callback' => 'callback/callback',
    //'chart' => 'chart/chart',
    //'screens' => 'about/about',
    'news/([0-9]+)' => 'news/view/$1',
    'news' => 'news/index',

    'catalog' => 'catalog/catalog',
    'catalog/p([0-9]+)' => 'catalog/catalog/$1',

    'category/([0-9]+)' => 'catalog/category/$1',
    'category/([0-9]+)/p([0-9]+)' => 'catalog/category/$1/$2',

    //'product' => 'product/product',
    'product/([0-9]+)' => 'product/product/$1',

    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'user/edit' => 'user/edit',
    'user' => 'user/user',

    'cart' => 'cart/cart',
    'cart/add/([0-9]+)' => 'cart/add/$1',
    'cart/delete/([0-9]+)' => 'cart/delete/$1'
];

<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 10-Feb-19
 * Time: 01:32
 */

return

    [
//  Главная страница
        '' => 'main/main',
        //'download' => 'download/download',
//  Обратная связь
        'callback' => 'callback/callback',
        'callback/send' => 'callback/send',
//  Новости
        //'chart' => 'chart/chart',
        //'screens' => 'about/about',
        'news/([0-9]+)' => 'news/view/$1',
        'news' => 'news/index',
//  Каталог
        'catalog' => 'catalog/catalog',
        'catalog/p([0-9]+)' => 'catalog/catalog/$1',
//  Категории
        'category/([0-9]+)' => 'catalog/category/$1',
        'category/([0-9]+)/p([0-9]+)' => 'catalog/category/$1/$2',
//  Товары
        //'product' => 'product/product',
        'product/([0-9]+)' => 'product/product/$1',
//  Пользлватель
        'user/register' => 'user/register',
        'user/login' => 'user/login',
        'user/logout' => 'user/logout',
        'user/edit' => 'user/edit',
        'user/history' => 'user/history',
        'user/history/details/([0-9]+)' => 'user/details/$1',
        'user' => 'user/user',
//  Корзина
        'cart' => 'cart/cart',
        'cart/add/([0-9]+)' => 'cart/add/$1',
        'cart/delete/([0-9]+)' => 'cart/delete/$1',
        'cart/checkout' => 'cart/checkout',
//  Админпанель
        'admin' => 'admin/admin',
//  Управление товарами
        'admin/product/create' => 'adminProduct/create',
        'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
        'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
        'admin/product' => 'adminProduct/AdminProduct'
    ];

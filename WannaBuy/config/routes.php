<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 10-Feb-19
 * Time: 01:32
 */

return
[
    'index' => 'main/index',
    'news/([a-z]+)/([0-9]+)' => 'news/view/$1/$2',
    'about' => 'about/index',
    'products' => 'product/list',
];
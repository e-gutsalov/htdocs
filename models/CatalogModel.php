<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 18-Nov-19
 * Time: 20:19
 */

namespace models;

class CatalogModel
{
    public static $title = 'Каталог';
    public static $cat = 'catalog';

    public static function getCatalog()
    {
        return $filename = ['head', 'nav', 'catalog', 'footer'];
    }

    public static function getParam()
    {
        return $param = ['catalog' => 'active', 'script' => 'wb-chart'];
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 03-Mar-19
 * Time: 23:14
 */

namespace models;


class MainModel
{
    public static $title = 'Главная';
    public static $main = 'main';

    public static function getMain()
    {
        return $filename = ['head', 'nav', 'main', 'footer'];
    }

    public static function getParam()
    {
        return $param = ['main' => 'active'];
    }
}

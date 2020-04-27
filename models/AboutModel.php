<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 05-Mar-19
 * Time: 21:03
 */

namespace models;


class AboutModel
{
    public static string $title = 'О нас';
    public static string $main = 'about';

    public static function getMain()
    {
        return $filename = [ 'head', 'nav', 'screenshots', 'footer' ];
    }

    public static function getParam()
    {
        return $param = [ 'screens' => 'active' ];
    }
}

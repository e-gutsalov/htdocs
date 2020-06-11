<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 03-Mar-19
 * Time: 23:18
 */

namespace views;

use components\Render;

class MainView
{
    private static array $filename = ['head', 'nav', 'main.tpl/catalog', 'main.tpl/catalog_menu', 'main.tpl/carousel', 'main.tpl/product', 'footer'];

    public static function getView( array $param )
    {
        $render = new Render( self::$filename, $param );
        $render->show();
    }
}

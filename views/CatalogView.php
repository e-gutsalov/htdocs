<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 18-Nov-19
 * Time: 20:20
 */

namespace views;

use components\Render;

class CatalogView
{
    private static array $filename = ['head', 'nav', 'catalog.tpl/catalog', 'catalog.tpl/catalog_menu', 'catalog.tpl/product', 'catalog.tpl/pagination', 'footer'];

    public static function getView( array $param )
    {
        $render = new Render( self::$filename, $param );
        $render->show();
    }
}

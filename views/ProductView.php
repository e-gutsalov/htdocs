<?php


namespace views;

use components\Render;

class ProductView
{
    private static array $filename = ['head', 'nav', 'product.tpl/product_details', 'footer'];

    public static function getView( array $param )
    {
        $render = new Render( self::$filename, $param );
        $render->show();
    }
}

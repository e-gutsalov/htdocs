<?php


namespace views;


use components\Render;

class AdminProductView
{
    private static array $filename = [ 'head', 'admin.tpl/header_admin', 'admin.tpl/product_admin', 'admin.tpl/footer_admin', 'footer' ];

    public static function getView( array $param )
    {
        $render = new Render( self::$filename, $param );
        $render->show();
    }
}

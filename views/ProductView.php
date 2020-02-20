<?php


namespace views;

use components\Buffer;
use components\Render;

class ProductView
{
    public static function getView( $filename, $param )
    {
        $buffer = new Buffer( $filename );
        $pages = $buffer->view();
        $render = new Render( $pages, $param );
        $render->parseProductDetails();
        $render->show();
    }
}

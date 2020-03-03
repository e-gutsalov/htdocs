<?php


namespace views;

//use components\Buffer;
use components\Render;

class ProductView
{
    public static function getView( array $filename, array $param )
    {
        //$buffer = new Buffer( $filename );
        //$pages = $buffer->view();
        $render = new Render( $filename, $param );
        //$render->parseProductDetails();
        $render->show();
    }
}

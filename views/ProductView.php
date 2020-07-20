<?php


namespace views;

use components\Render;

class ProductView
{
    public static function getView( array $param )
    {
        $render = new Render( $param[ 'filename' ], $param );
        $render->show();
    }
}

<?php


namespace views;


use components\Render;

class AdminProductView
{
    public static function getView( array $param )
    {
        $render = new Render( $param[ 'filename' ], $param );
        $render->show();
    }
}

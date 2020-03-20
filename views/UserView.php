<?php


namespace views;


use components\Render;

class UserView
{
    public static function getView( array $filename, array $param )
    {
        $render = new Render( $filename, $param );
        $render->show();
    }
}

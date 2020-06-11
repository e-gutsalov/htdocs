<?php


namespace views;


use components\Render;

class UserView
{
    public static function getView( array $param )
    {
        $render = new Render( $param['page'], $param );
        $render->show();
    }
}

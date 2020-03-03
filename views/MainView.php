<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 03-Mar-19
 * Time: 23:18
 */

namespace views;

//use components\Buffer;
use components\Render;

class MainView
{
    public static function getView( array $filename, array $param )
    {
        //$buffer = new Buffer( $filename );
        //$pages = $buffer->view();
        $render = new Render( $filename, $param );
        //$render->parseMenu();
        //$render->parseProduct();
        $render->show();
    }
}

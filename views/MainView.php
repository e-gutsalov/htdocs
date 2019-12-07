<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 03-Mar-19
 * Time: 23:18
 */

namespace views;

use components\Buffer;
use components\Render;

class MainView
{
    public static function getView( $filename, $param )
    {
        $buffer = new Buffer( $filename );
        $pages = $buffer->view();
        $render = new Render( $pages, $param );
        $render->parseMenu();
        $render->show();
    }
}

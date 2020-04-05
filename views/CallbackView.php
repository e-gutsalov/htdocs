<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 26-Feb-19
 * Time: 21:11
 */

namespace views;

//use components\Buffer;
use components\Render;


class CallbackView
{
    public static function getView( array $filename, array $param )
    {
        $render = new Render( $filename, $param );
        $render->show();
    }
}

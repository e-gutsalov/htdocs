<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 26-Feb-19
 * Time: 21:11
 */

namespace views;

use components\Render;


class CallbackView
{
    public static array $filename = [ 'head', 'nav', 'callback', 'footer' ];

    public static function getView( array $param )
    {
        $render = new Render( self::$filename, $param );
        $render->show();
    }
}

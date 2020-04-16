<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 05-Mar-19
 * Time: 21:03
 */

namespace views;


use components\Buffer;
use components\Render;

class AboutView
{
    public static function getView( $filename, $param )
    {
        $render = new Render( $filename, $param );
        $render->show();
    }
}

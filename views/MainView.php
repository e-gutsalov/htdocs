<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 03-Mar-19
 * Time: 23:18
 */

namespace views;

use components\Render;

class MainView
{
    public static function getView( array $param )
    {
        $render = new Render( $param[ 'filename' ], $param );
        $render->show();
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 11-Mar-19
 * Time: 20:01
 */

namespace views;

use components\Buffer;
use components\Render;

class ChartView
{
    public static function getView( $filename, $param )
    {
        $render = new Render( $filename, $param );
        $render->show();
    }
}

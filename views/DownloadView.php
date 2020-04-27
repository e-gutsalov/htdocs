<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 04-Mar-19
 * Time: 22:04
 */

namespace views;


use components\Render;

class DownloadView
{
    public static function getView( array $filename, array $param )
    {
        $render = new Render( $filename, $param );
        $render->show();
    }
}

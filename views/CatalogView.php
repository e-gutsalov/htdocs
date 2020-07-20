<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 18-Nov-19
 * Time: 20:20
 */

namespace views;

use components\Render;

class CatalogView
{
    public static function getView( array $param )
    {
        $render = new Render( $param[ 'filename' ], $param );
        $render->show();
    }
}

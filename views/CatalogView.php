<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 18-Nov-19
 * Time: 20:20
 */

namespace views;

use components\Buffer;
use components\Render;

class CatalogView
{
    public static function getView( $filename, $param )
    {
        $buffer = new Buffer( $filename );
        $pages = $buffer->view();
        $render = new Render( $pages, $param );
        $render->parseMenu();
        $render->parseProduct();
        $render->show();
    }
}

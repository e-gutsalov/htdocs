<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 18-Nov-19
 * Time: 20:20
 */

namespace views;

//use components\Buffer;
use components\Render;

class CatalogView
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

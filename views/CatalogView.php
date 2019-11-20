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
    public static function getView($filename, $param, $out)
    {
        $buffer = new Buffer($filename);
        $page = $buffer->view();
        $render = new Render($page, $param);
        $render->show();
        print_r($out);
    }
}

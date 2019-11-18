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
    public static function getView($filename, $param)
    {
        $buffer = new Buffer($filename);
        $page = $buffer->view();
        $render = new Render($page, $param);
        $render->show();
    }
}

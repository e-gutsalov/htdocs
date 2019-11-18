<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 26-Feb-19
 * Time: 21:11
 */

namespace views;

use components\Buffer;
use components\Render;

//spl_autoload_register();

class CallbackView
{
    public static function getView($filename, $param)
    {
        $buffer = new Buffer($filename);
        $page = $buffer->view();
        $render = new Render($page, $param);
        $render->show();
    }
}

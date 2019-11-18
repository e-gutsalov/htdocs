<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 04-Mar-19
 * Time: 22:04
 */

namespace views;


use components\Buffer;
use components\Render;

class DownloadView
{
    public static function getView($filename, $param)
    {
        $buffer = new Buffer($filename);
        $page = $buffer->view();
        $render = new Render($page, $param);
        $render->show();
    }
}

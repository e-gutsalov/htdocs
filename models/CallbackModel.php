<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 26-Feb-19
 * Time: 21:23
 */

namespace models;

class CallbackModel
{
    public static string $title = 'Обратная связь';
    public static string $about = 'callback';

    public static function getCallback()
    {
        return $filename = ['head', 'nav', 'callback', 'footer'];
    }

    public static function getParam()
    {
        return $param = [
                            'callback' => 'active',
                            'script' => 'wb-valid',
                            'title' => 'Обратная связь',
                        ];
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 26-Feb-19
 * Time: 21:23
 */

namespace models;

use components\SendMail;

class CallbackModel
{
    public static string $title = 'Обратная связь';
    public static string $about = 'callback';
    private static object $sendMail;

    public static function getCallback()
    {
        return $filename = ['head', 'nav', 'callback', 'footer'];
    }

    public static function getParam()
    {
        return $param =
            [
                'callback' => 'active',
                'script' => 'handi-valid',
                'title' => 'Обратная связь',
                'sess' => $_SESSION
            ];
    }

    public static function sendMail()
    {
        self::$sendMail = new SendMail();
        //return self::$sendMail->send();
        return self::$sendMail->checkMail();
    }
}

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
    private static array $inputs = [];
    private static object $sendMail;
    private static object $paramsMail;
    private static string $json = '';
    private static string $statusSend = '';

    public static function getParam()
    {
        return $param =
            [
                'filename' => [ 'head', 'nav', 'callback', 'footer' ],
                'callback' => 'active',
                'script' => 'handi-valid',
                'title' => 'Обратная связь',
                'sess' => $_SESSION
            ];
    }

    public static function sendMail()
    {
        self::checkInputs();
        self::$json = self::messageSite();
        if ( self::$statusSend ) {
            self::$sendMail = new SendMail();
            self::$sendMail->send( self::$paramsMail );
            return self::$json;
        } else {
            return self::$json;
        }
    }

    public static function messageSite()
    {
        if ( !in_array( false, self::$inputs ) ) {
            self::$statusSend = true;
            self::$paramsMail = new \stdClass();
            self::$paramsMail->subject = 'Обращение на сайте gutsalov.h1n.ru';
            self::$paramsMail->email = self::$inputs[ 'InputEmail' ];
            self::$paramsMail->body = self::$inputs[ 'InputName' ] . ', спасибо за ваше обращение! Мы рассмотрим его в ближайшее время! <br>' . self::$inputs[ 'InputEmail' ] . '<br>' . self::$inputs[ 'InputPhone' ] . '<br>' . 'Текст обращения:' . '<br>' . self::$inputs[ 'InputText' ];
            return json_encode( [
                'success' => true,
                'title' => 'Ваше обращение принято!',
                'message' => self::$paramsMail->body
            ] );
        } else {
            self::$statusSend = false;
            return json_encode( [
                'success' => false,
                'title' => 'Во время отправки возникли ошибки!',
                'message' => 'Необходимо заполнить все поля формы обратной связи!'
            ] );
        }
    }

    public static function checkInputs()
    {
        // Если форма отправлена
        // Получаем данные из формы
        $definition = [
            'InputName' => FILTER_SANITIZE_STRING,
            'InputEmail' => FILTER_VALIDATE_EMAIL,
            'InputPhone' => FILTER_SANITIZE_NUMBER_INT,
            'InputText' => FILTER_SANITIZE_STRING
        ];

        self::$inputs = filter_input_array( INPUT_POST, $definition );
    }
}

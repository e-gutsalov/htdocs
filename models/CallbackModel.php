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
    private static array $inputs = [];
    private static object $sendMail;
    private static object $paramsMail;

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
        self::$inputs = self::$sendMail->checkInputs();
        self::$paramsMail = new \stdClass();
        self::$paramsMail->subject = 'Обращение на сайте gutsalov.h1n.ru';
        self::$paramsMail->email = self::$inputs['InputEmail'];
        self::$paramsMail->body = self::$inputs['InputName'] . ', спасибо за ваше обращение! Мы рассмотрим его в ближайшее время! <br>' . self::$inputs['InputEmail'] . '<br>' . self::$inputs['InputPhone'] . '<br>' . 'Текст обращения:'. '<br>' . self::$inputs['InputText'];
        self::$paramsMail->json = self::messageSite();
        if ( self::$paramsMail->statusSend ){
            self::$sendMail->send( self::$paramsMail );
            return self::$paramsMail->json;
        } else {
            return self::$paramsMail->json;
        }
    }

    public static function messageSite()
    {
        if ( !in_array( false, self::$inputs ) ) {
            self::$paramsMail->statusSend = true;
            return json_encode( [
                'success' => true,
                'title' => 'Ваше обращение принято!',
                'message' => self::$paramsMail->body
            ] );
        } else {
            self::$paramsMail->statusSend = false;
            return json_encode( [
                'success' => false,
                'title' => 'Во время отправки возникли ошибки!',
                'message' => 'Необходимо заполнить все поля формы обратной связи!'
            ] );
        }
    }
}

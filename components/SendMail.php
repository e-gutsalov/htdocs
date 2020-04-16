<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 25-Feb-19
 * Time: 20:52
 */

namespace components;

use includes\PHPMailer\PHPMailer\PHPMailer;
use includes\PHPMailer\PHPMailer\Exception;

class SendMail
{
    private object $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer( true );
    }

    public function send( object $paramsMail )
    {
        $this->mail->isSMTP();
        // IP или хостнейм сервера, на котором находится Ваш почтовый аккаунт. Этот адрес Вы можете найти в письме с данными от хостинг-аккаунта.
        $this->mail->Host = 'smtp.yandex.ru';
        $this->mail->SMTPAuth = true;
        // наименование почтового ящика, или логин на почтовом сервере. Как правило, Вы указываете его, когда создаете почтовый ящик.
        $this->mail->Username = 'handicraft@gutsalov.h1n.ru';
        // пароль от почтового ящика.
        $this->mail->Password = '!123qweasd';
        $this->mail->SMTPSecure = 'ssl';
        $this->mail->Port = '465';
        $this->mail->SMTPOptions = [ 'ssl' => [ 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true, ] ];
        $this->mail->setLanguage( 'ru', '../language/' );
        // укажите 4, если почта не отправляется, чтобы узнать, почему
        $this->mail->SMTPDebug = 0;

        // далее следует код, который отвечает за отправку письма
        // укажите почтовый ящик отправителя. Рекомендуем указывать такой же, который указываем в авторизационных данных - LOGIN@DOMAIN.RU
        $this->mail->From = 'handicraft@gutsalov.h1n.ru';
        // укажите имя отправителя, например "Сайт DOMAIN.RU"
        $this->mail->FromName = 'gutsalov.h1n.ru';
        // укажите тему сообщения здесь
        $this->mail->Subject = $paramsMail->subject;
        // текст сообщения
        $this->mail->Body = $paramsMail->body;
        // кодировка, можете изменить на необходимую, но чаще всего используется UTF-8
        $this->mail->CharSet = 'UTF-8';
        //  укажите true вместо false, если хотите, чтобы сообщение обрабатывалось как HTML
        $this->mail->isHTML( true );

        // укажите почтовый адрес получателя
        try {
            $this->mail->addAddress( $paramsMail->email );
        } catch ( Exception $e ) {
            echo $e->errorMessage();
        }

        // отправляем письмо
        try {
            $this->mail->send();
            return true;
        } catch ( Exception $e ) {
            echo $e->getMessage();
            return false;
        }
    }
}

/*
if ( ( !empty( $_GET['InputEmail'] ) and !empty( $_GET['InputText'] ) ) )
{

    $name	 = $_GET['InputName'];
    $email 	 = $_GET['InputEmail'];
    $text    = $_GET['InputText'];
    $to      = 'egutsalov@yandex.ru';
    $subject = 'Поступил заказ от клиента!';
    $message = 'Поступил заказ от клиента!' . "\r\n" . 'Почта клиента: ' . "<$email>" . "\r\n" . "$text" . "\r\n";
    $headers = 'From: <e-gutsalov@mail.ru>';
    mail( $to, $subject, $message, $headers );


    echo '<br>' . $name . ', спасибо за обращение! Мы рассмотрим его в ближайшее время <br>',  $email, '<br>', $text,  '<br>';
}
else
{
    echo '<br>Необходимо заполнить все поля формы обратной связи!';
}
*/

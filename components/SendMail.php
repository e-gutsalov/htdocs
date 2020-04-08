<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 25-Feb-19
 * Time: 20:52
 */

namespace components;

use includes\PHPMailer\PHPMailer\PHPMailer;
//use includes\PHPMailer\PHPMailer\SMTP;
use includes\PHPMailer\PHPMailer\Exception;

class SendMail
{
    private string $name = '';
    private string $email = '';
    private string $text = '';
    private object $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
    }

    public function send()
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
        $this->mail->SMTPOptions = ['ssl' => ['verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true,]];
        $this->mail->setLanguage('ru', '../language/');
        // укажите 4, если почта не отправляется, чтобы узнать, почему
        $this->mail->SMTPDebug = 0;

    // далее следует код, который отвечает за отправку письма
    // укажите почтовый ящик отправителя. Рекомендуем указывать такой же, который указываем в авторизационных данных - LOGIN@DOMAIN.RU
        $this->mail->From = 'handicraft@gutsalov.h1n.ru';
    // укажите имя отправителя, например "Сайт DOMAIN.RU"
        $this->mail->FromName = 'gutsalov.h1n.ru';
    // укажите тему сообщения здесь
        $this->mail->Subject = 'Поступил заказ от клиента!';
    // текст сообщения
        $this->mail->Body = $this->text;
    // кодировка, можете изменить на необходимую, но чаще всего используется UTF-8
        $this->mail->CharSet = 'UTF-8';
    //  укажите true вместо false, если хотите, чтобы сообщение обрабатывалось как HTML
        $this->mail->isHTML( true );

    // укажите почтовый адрес получателя
        try {
            $this->mail->addAddress( $this->email );
        } catch ( Exception $e ) {
            echo $e->errorMessage();
        }

    // отправляем письмо
        try {
            $this->mail->send();
            echo '<br>' . $this->name . ', спасибо за обращение! Мы рассмотрим его в ближайшее время! <br>', $this->email, '<br>', $this->text, '<br>';
        } catch ( Exception $e ) {
            echo $e->getMessage();
        }
    }

    public function checkMail()
    {
        if ( !empty( $_POST['InputEmail'] ) and !empty( $_POST['InputName'] ) and !empty( $_POST['InputText'] ) ) {

            //$to = 'egutsalov@yandex.ru';

            // Если форма отправлена
            // Получаем данные из формы
            $this->name = filter_input(INPUT_POST, 'InputName', FILTER_SANITIZE_STRING);
            $this->email = filter_input(INPUT_POST, 'InputEmail', FILTER_SANITIZE_EMAIL);
            $this->text = filter_input(INPUT_POST, 'InputText', FILTER_SANITIZE_STRING);

//            echo '<br>' . $this->name . ', спасибо за обращение! Мы рассмотрим его в ближайшее время! <br>', $this->email, '<br>', $this->text, '<br>';
            return json_encode( ['success' => true, 'text' => "$this->name, спасибо за ваше обращение! Мы рассмотрим его в ближайшее время! <br> $this->email <br> $this->text"] );
        } else {
//            echo '<br> Необходимо заполнить все поля формы обратной связи!';
            return json_encode( ['success' => false, 'text' => 'Необходимо заполнить все поля формы обратной связи!'] );
        }
    }
}



/*
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
*/
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
/*
if ( ( !empty( $_GET['InputEmail'] ) and !empty( $_GET['InputText'] ) ) ) {

    $name = $_GET['InputName'];
    $email = $_GET['InputEmail'];
    $text = $_GET['InputText'];
    //$to = 'egutsalov@yandex.ru';

    $mail = new PHPMailer();

    $mail->isSMTP();
// IP или хостнейм сервера, на котором находится Ваш почтовый аккаунт. Этот адрес Вы можете найти в письме с данными от хостинг-аккаунта.
    $mail->Host = 'smtp.yandex.ru';
    $mail->SMTPAuth = true;
// наименование почтового ящика, или логин на почтовом сервере. Как правило, Вы указываете его, когда создаете почтовый ящик.
    $mail->Username = 'handicraft@gutsalov.h1n.ru';
// пароль от почтового ящика.
    $mail->Password = '!123qweasd';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = '465';
    $mail->SMTPOptions = ['ssl' => ['verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true,]];

// далее следует код, который отвечает за отправку письма
// укажите почтовый ящик отправителя. Рекомендуем указывать такой же, который указываем в авторизационных данных - LOGIN@DOMAIN.RU
    $mail->From = 'handicraft@gutsalov.h1n.ru';
// укажите имя отправителя, например "Сайт DOMAIN.RU"
    $mail->FromName = 'gutsalov.h1n.ru';
// укажите тему сообщения здесь
    $mail->Subject = 'Поступил заказ от клиента!';
// текст сообщения
    $mail->Body = $text;
// кодировка, можете изменить на необходимую, но чаще всего используется UTF-8
    $mail->CharSet = 'UTF-8';
//  укажите true вместо false, если хотите, чтобы сообщение обрабатывалось как HTML
    $mail->isHTML( true );
// укажите почтовый адрес получателя
    try {
        $mail->addAddress( $email );
    } catch ( Exception $e ) {
        echo $e->errorMessage();
    }
// укажите 4, если почта не отправляется, чтобы узнать, почему
    $mail->SMTPDebug = 0;
// отправляем письмо
    try {
         $mail->send();
         echo '<br>' . $name . ', спасибо за обращение! Мы рассмотрим его в ближайшее время! <br>', $email, '<br>', $text, '<br>';
    } catch ( Exception $e ) {
        echo $e->getMessage();
    }
} else {
        echo '<br>Необходимо заполнить все поля формы обратной связи!';
    }
*/

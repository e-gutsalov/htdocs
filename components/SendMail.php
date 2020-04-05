<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 25-Feb-19
 * Time: 20:52
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

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
    $mail->Subject = 'ТЕСТ';
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

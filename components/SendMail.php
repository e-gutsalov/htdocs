<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 25-Feb-19
 * Time: 20:52
 */

if ( ( !empty( $_GET['InputEmail'] ) and !empty( $_GET['InputText'] ) ) )
{
    $email = $_GET['InputText'];
    $text = $_GET['InputEmail'];

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

<?php

header("Content-Type: text/html; charset=UTF-8");
header("Content-Language: ru");

spl_autoload_register();

//$read_GET = isset($_GET['mark_read']) ? $_GET['mark_read'] : NULL;

$read_GET = '';
$unread_GET = '';

if (isset($_GET['mark_read']))
{
    $read_GET = $_GET['mark_read'];
}
if (isset($_GET['mark_unread']))
{
    $unread_GET = $_GET['mark_unread'];
}
$model = new model($read_GET, $unread_GET);
$view = new view($model);
$view->Display();
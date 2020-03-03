<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 04-Mar-19
 * Time: 22:04
 */

namespace models;


class DownloadModel
{
    public static string $title = 'Загрузка';
    public static string $down = 'download';

    public static function getDownload()
    {
        return $filename = ['head', 'nav', 'download', 'footer'];
    }

    public static function getParam()
    {
        return $param = ['download' => 'active'];
    }
}

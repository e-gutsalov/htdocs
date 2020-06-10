<?php


namespace models;


class AdminModel
{
    private static array $filename;
    private static array $param;

    public static function getAdminPage()
    {
        return self::$filename = ['head', 'header_admin', 'admin', 'footer_admin', 'footer'];
    }

    public static function getParam()
    {
        return self::$param =
            [
                'id' => 0,
                'title' => 'Админпанель',
                'name' => 'Каталог сейчас недоступен!',
                'admin' => 'active',
                'script' => 'handi',
                'sess' => $_SESSION
            ];
    }
}

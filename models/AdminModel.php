<?php


namespace models;


class AdminModel
{
    private static array $param;

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

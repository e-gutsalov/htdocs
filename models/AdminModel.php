<?php


namespace models;


class AdminModel
{
    private static array $param;

    public static function getParam()
    {
        return self::$param =
            [
                'filename' => ['head', 'admin.tpl/header_admin', 'admin.tpl/admin', 'admin.tpl/footer_admin', 'footer'],
                'title' => 'Админпанель',
                'name' => 'Каталог сейчас недоступен!',
                'admin' => 'active',
                'script' => 'handi',
                'sess' => $_SESSION
            ];
    }
}

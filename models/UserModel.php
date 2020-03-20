<?php


namespace models;


use components\Db;
use components\UserProcess;

class UserModel
{
    private static array $filename;
    private static array $param;
    private static object $db;
    private static object $process;
    private static string $Page = '';

    public static function getUserPage()
    {
        self::$db = Db::getConnection();
        return self::$filename = ['head', 'nav', self::$Page, 'footer'];
    }

    public static function getParam()
    {
        return self::$param =
            [
                'id' => 0,
                'title' => 'Регистрация пользователя',
                'reg' => 'active',
                'script' => 'wb',
                'process' => self::$process
            ];
    }

    public static function userRegister()
    {
        self::$Page = 'register';
        self::$process = new UserProcess();
        self::$process->userRegisterProcess();
    }

    public static function userLogin()
    {
        self::$Page = 'login';
        self::$process = new UserProcess();
        self::$process->userLoginProcess();
    }

    public static function userProfile()
    {
        self::$Page = 'profile';
        self::$process = new UserProcess();
        self::$process->checkLogged();
    }
}

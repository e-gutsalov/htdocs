<?php


namespace models;


use components\Db;
use components\UserProcess;

class UserModel
{
    private static array $filename;
    private static array $param;
    private static object $db;
    private static object $userProcess;
    private static string $page = '';

    public static function getUserPage()
    {
        self::$db = Db::getConnection();
        return self::$filename = ['head', 'nav', self::$page, 'footer'];
    }

    public static function getParam()
    {
        return self::$param =
            [
                'id' => 0,
                'title' => 'Пользователь',
                'reg' => 'active',
                'script' => 'handi',
                'userProcess' => self::$userProcess,
                'sess' => $_SESSION
            ];
    }

    public static function userRegister()
    {
        self::$page = 'register';
        self::$userProcess = new UserProcess();
        self::$userProcess->userRegisterProcess();
    }

    public static function userLogin()
    {
        self::$page = 'login';
        self::$userProcess = new UserProcess();
        self::$userProcess->userLoginProcess();
    }

    public static function userProfile()
    {
        self::$page = 'profile';
        self::$userProcess = new UserProcess();
        self::$userProcess->checkLogged();
    }

    public static function userEdit()
    {
        self::$page = 'edit';
        self::$userProcess = new UserProcess();
        self::$userProcess->checkLogged();
        self::$userProcess->userEditProcess();
    }
}

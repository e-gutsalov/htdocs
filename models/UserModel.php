<?php


namespace models;


use components\UserProcess;

class UserModel
{
    private static array $param;
    private static object $userProcess;
    private static string $page = '';

    public static function getParam()
    {
        return self::$param =
            [
                'page' => ['head', 'nav', 'user.tpl/' . self::$page, 'footer'],
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

    public static function userHistory()
    {
        self::$page = 'history';
        self::$userProcess = new UserProcess();
        self::$userProcess->checkLogged();
        self::$userProcess->getOrdersListByUser();
    }

    public static function userHistoryDetails( int $customers_id )
    {
        self::$page = 'history_details';
        self::$userProcess = new UserProcess();
        self::$userProcess->checkLogged();
        self::$userProcess->getOrdersDetailsByUser( $customers_id );
    }
}

<?php


namespace controllers;


use components\UserProcess;

/**
 * Абстрактный класс AdminBase содержит общую логику для контроллеров, которые
 * используются в панели администратора
 */
abstract class AdminBase
{
    /**
     * Метод, который проверяет пользователя на то, является ли он администратором
     * @return boolean
     */
    public static function checkAdmin() : bool
    {
        $UserProcess = new UserProcess();

        // Проверяем авторизирован ли пользователь. Если нет, он будет переадресован
        $UserProcess->checkLogged();

        // Получаем информацию о текущем пользователе
        $user = $UserProcess->getUserById( $_SESSION[ 'user' ]->id );

        // Если роль текущего пользователя "admin", пускаем его в админпанель
        if ( $user->role == 'admin' ) {
            return true;
        }

        // Иначе завершаем работу с сообщением об закрытом доступе
        exit( 'Access denied' );
    }
}

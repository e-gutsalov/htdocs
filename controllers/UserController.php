<?php


namespace controllers;


use models\UserModel;
use views\UserView;

class UserController
{
    /**
     * Action для страницы "Регистрация на сайт"
     */
    public function actionRegister()
    {
        UserModel::userRegister();
        $param = UserModel::getParam();
        $filename = UserModel::getUserPage();
        UserView::getView( $filename, $param );
    }

    /**
    * Action для страницы "Вход на сайт"
    */
    public function actionLogin()
    {
        UserModel::userLogin();
        $param = UserModel::getParam();
        $filename = UserModel::getUserPage();
        UserView::getView( $filename, $param );
    }

    /**
     * Action для страницы "Профиль"
     */
    public function actionUser()
    {
        UserModel::userProfile();
        $param = UserModel::getParam();
        $filename = UserModel::getUserPage();
        UserView::getView( $filename, $param );
    }

    /**
     * Удаляем данные о пользователе из сессии
     */
    public function actionLogout()
    {
        // Удаляем информацию о пользователе из сессии
        unset( $_SESSION['user'] );

        // Перенаправляем пользователя на главную страницу
        header( 'Location: /' );
    }
}

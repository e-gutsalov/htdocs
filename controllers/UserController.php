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
        UserView::getView( $param );
    }

    /**
     * Action для страницы "Вход на сайт"
     */
    public function actionLogin()
    {
        UserModel::userLogin();
        $param = UserModel::getParam();
        UserView::getView( $param );
    }

    /**
     * Action для страницы "Профиль"
     */
    public function actionUser()
    {
        UserModel::userProfile();
        $param = UserModel::getParam();
        UserView::getView( $param );
    }

    /**
     * Action для страницы "Редактирование данных пользователя"
     */
    public function actionEdit()
    {
        UserModel::userEdit();
        $param = UserModel::getParam();
        UserView::getView( $param );
    }

    /**
     * Action для страницы "Список покупок"
     */
    public function actionHistory()
    {
        UserModel::userHistory();
        $param = UserModel::getParam();
        UserView::getView( $param );
    }

    /**
     * Action для страницы "Детализация списка покупок"
     * @param $customers_id
     */
    public function actionDetails( $customers_id )
    {
        UserModel::userHistoryDetails( $customers_id );
        $param = UserModel::getParam();
        UserView::getView( $param );
    }

    /**
     * Удаляем данные о пользователе из сессии
     */
    public function actionLogout()
    {
        // Удаляем информацию о пользователе из сессии
        unset( $_SESSION[ 'user' ] );

        // Перенаправляем пользователя на главную страницу
        header( 'Location: /' );
    }
}

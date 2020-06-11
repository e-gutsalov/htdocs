<?php


namespace controllers;


use models\AdminModel;
use views\AdminView;

/**
 * Контроллер AdminController
 * Главная страница в админпанели
 */
class AdminController extends AdminBase
{
    /**
     * Action для стартовой страницы "Панель администратора"
     */
    public function actionAdmin()
    {
        // Проверка доступа
        self::checkAdmin();

        $param = AdminModel::getParam();
        AdminView::getView( $param );
    }
}

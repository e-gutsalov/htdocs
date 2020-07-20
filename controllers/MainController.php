<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 12-Feb-19
 * Time: 23:44
 */

namespace controllers;

use models\MainModel;
use views\MainView;

class MainController
{
    public function actionMain()
    {
        MainModel::getCategoriesList();
        MainModel::getLatestProducts();
        MainModel::getCountProducts();
        MainModel::getRecommendedProducts();
        $param = MainModel::getParam();
        MainView::getView( $param );
    }
}

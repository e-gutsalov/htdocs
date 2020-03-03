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
        $filename = MainModel::getMainPage();
        MainModel::getCategoriesList();
        MainModel::getLatestProducts();
        MainModel::getImagesCarousel();
        $param = MainModel::getParam();
        MainView::getView( $filename, $param );
    }
}

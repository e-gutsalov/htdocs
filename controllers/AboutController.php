<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 05-Mar-19
 * Time: 20:52
 */

namespace controllers;


use models\AboutModel;
use views\AboutView;

class AboutController
{
    public function actionAbout()
    {
        $filename = AboutModel::getMain();
        $param = AboutModel::getParam();
        AboutView::getView( $filename, $param );
    }
}

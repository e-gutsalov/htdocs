<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 04-Mar-19
 * Time: 21:36
 */

namespace controllers;


use models\DownloadModel;
use views\DownloadView;

class DownloadController
{
    public function actionDownload()
    {
        $filename = DownloadModel::getDownload();
        $param = DownloadModel::getParam();
        DownloadView::getView( $filename, $param );
    }
}

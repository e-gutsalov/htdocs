<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 11-Mar-19
 * Time: 20:00
 */

namespace controllers;

use models\ChartModel;
use views\ChartView;

class ChartController
{
    public function actionChart()
    {
        $filename = ChartModel::getChart();
        $param = ChartModel::getParam();
        ChartView::getView( $filename, $param );
    }
}
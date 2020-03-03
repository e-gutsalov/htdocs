<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 11-Mar-19
 * Time: 20:00
 */

namespace models;

class ChartModel
{
    public static string $title = 'График';
    public static string $main = 'chart';

    public static function getChart()
    {
        return $filename = ['head', 'nav', 'chart', 'footer'];
    }

    public static function getParam()
    {
        return $param = ['chart' => 'active', 'script' => 'wb-chart'];
    }
}

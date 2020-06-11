<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 12-Feb-19
 * Time: 22:20
 */

namespace controllers;

use models\NewsModel;

class NewsController
{
    public string $menuItem = 'NewsModel';

    public function actionIndex()
    {
        NewsModel::getNewsList();
        NewsModel::view( $this->menuItem );

    }

    public function actionView( $category = null, $id = null )
    {
        echo '<br>' . $category;
        echo '<br>' . $id;
        echo '<br> NewsController';
    }
}

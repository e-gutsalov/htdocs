<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 12-Feb-19
 * Time: 22:20
 */

namespace controllers;

use models\NewsModel;

spl_autoload_register();

class NewsController
{
    public
        $menuItem = 'NewsModel';

    public function actionIndex()
    {
        echo '<br> Список новостей NewsController';
        NewsModel::getNewsList();
        NewsModel::view($this->menuItem);

    }

    public function actionView($category = null, $id = null)
    {
        echo '<br>'.$category;
        echo '<br>'.$id;
        echo '<br> NewsController';
    }
}
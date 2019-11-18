<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 12-Feb-19
 * Time: 22:20
 */

namespace controllers;

use models\News;

spl_autoload_register();

class NewsController
{
    public
        $menuItem = 'News';

    public function actionIndex()
    {
        echo '<br> Список новостей NewsController';
        News::getNewsList();
        News::view($this->menuItem);

    }

    public function actionView($category = null, $id = null)
    {
        echo '<br>'.$category;
        echo '<br>'.$id;
        echo '<br> NewsController';
    }
}
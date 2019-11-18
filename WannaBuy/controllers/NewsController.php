<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 12-Feb-19
 * Time: 22:20
 */

//namespace controllers;

class NewsController
{
    public function actionIndex()
    {
        echo 'Список новостей';
    }

    public function actionView($category = null, $id = null)
    {
        echo '<br>'.$category;
        echo '<br>'.$id;
        echo 'NewsController';
    }

}
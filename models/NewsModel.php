<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 17-Feb-19
 * Time: 01:03
 */

namespace models;

class NewsModel
{
    public static function getNewsItemById( $id )
    {
    }

    public static function getNewsList()
    {
        echo '<br> Список новостей NewsModel';
    }

    public static function view( $menuItem )
    {
        ob_start();
        include 'templates/head.html';
        include 'templates/nav.html';
        include 'templates/main.html';
        include 'templates/footer.html';
        $content = ob_get_contents();
        ob_end_clean();
        echo $content;
    }

}

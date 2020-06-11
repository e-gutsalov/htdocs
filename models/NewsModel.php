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
    }

    public static function view( $menuItem )
    {
        ob_start();
        include 'templates/head.tpl.php';
        include 'templates/nav.tpl.php';
        include 'templates/main.tpl.php';
        include 'templates/footer.tpl.php';
        $content = ob_get_contents();
        ob_end_clean();
        echo $content;
    }

}

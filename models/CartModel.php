<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 03-Mar-19
 * Time: 23:14
 */

namespace models;

use components\Db;
use PDO;

class CartModel
{
    private static array $filename;
    private static array $param;
    private static array $categoriesList;
    private static array $latestProducts;
    private static int $status = 1;
    private static int $category_id = 0;
    const SHOW_BY_PRODUCTS = 6;
    private static object $db;

    public static function getCartPage()
    {
        self::$db = Db::getConnection();
        return self::$filename = ['head', 'nav', 'cart', 'footer'];
    }

    public static function getParam()
    {
        return self::$param =
            [
                //'categoriesList' => self::$categoriesList,
                //'latestProducts' => self::$latestProducts,
                'id' => 0,
                'title' => 'Корзина',
                'name' => 'Каталог сейчас недоступен!',
                //'category' => self::$category_id,
                'cart' => 'active',
                'script' => 'wb'
            ];
    }

}

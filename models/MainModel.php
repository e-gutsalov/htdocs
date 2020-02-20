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

class MainModel
{

    private static string $title = 'Каталог';
    private static string $cat = 'catalog';
    private static array $filename;
    private static array $param;
    private static array $categoriesList;
    private static array $latestProducts;
    private static int $status = 1;
    const SHOW_BY_PRODUCTS = 6;

    public static function getMainPage()
    {
        return self::$filename = ['head', 'nav', 'main', 'carousel', 'catalog_menu', 'product', 'footer'];
    }

    public static function getParam()
    {
        return self::$param =
            [
                'categoriesList' => self::$categoriesList,
                'latestProducts' => self::$latestProducts,
                'page' => [
                           'catalog_menu' => 'catalog_menu',
                           'product' => 'product',
                           'strButton' => 6
                ],
                'id' => 0,
                'title' => 'Главная',
                'name' => 'Каталог сейчас недоступен!',
                'main' => 'active',
                'script' => 'wb'
            ];
    }

    /**
     * @return mixed
     */

    public static function getCategoriesList()
    {
        $db = Db::getConnection();

        $query = 'SELECT id, name, category FROM category WHERE status = :status ORDER BY category ASC';
        $stmt = $db->prepare( $query );
        $stmt->bindParam( ':status', self::$status );
        $stmt->execute();
        if ( $stmt->rowCount() > 0 )
        {
            while ( $row = $stmt->fetch() )
            {
                self::$categoriesList[] = $row;
            }
            return self::$categoriesList;
        }
        return self::$categoriesList[] = false;
    }

    public static function getLatestProducts( $count = self::SHOW_BY_PRODUCTS )
    {
        $db = Db::getConnection();

        $query = 'SELECT id, name, price, image, new, short_description FROM product WHERE status = :status ORDER BY id DESC LIMIT :count';
        $stmt = $db->prepare( $query );
        $stmt->bindParam( ':status', self::$status );
        $stmt->bindParam( ':count', $count, PDO::PARAM_INT );
        $stmt->execute();
        if ( $stmt->rowCount() > 0 )
        {
            while ( $row = $stmt->fetch() )
            {
                self::$latestProducts[] = $row;
            }
            return self::$latestProducts;
        }
        return self::$latestProducts[] = false;
    }

}

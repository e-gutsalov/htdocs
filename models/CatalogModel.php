<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 18-Nov-19
 * Time: 20:19
 */

namespace models;

use components\Db;
use PDO;

class CatalogModel
{

    private static string $title = 'Каталог';
    private static string $cat = 'catalog';
    private static array $filename;
    private static array $param;
    private static array $categoriesList;
    private static array $latestProducts;
    private static int $status = 1;
    private static int $category_id = 0;
    const SHOW_BY_PRODUCTS = 12;

    public static function getCatalogPage()
    {
        return self::$filename = ['head', 'nav', 'catalog', 'catalog_menu', 'product', 'prefooter', 'footer'];
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
                'title' => 'Каталог',
                'name' => 'Каталог сейчас недоступен!',
                'category_' . self::$category_id => 'list-group-item-danger',
                'catalog' => 'active',
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
        return self::$categoriesList[] = FALSE;
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
        return self::$latestProducts[] = FALSE;
    }

    public static function getProductsByCategory( $category )
    {
        self::$category_id = $category;

        $db = Db::getConnection();

        $query = 'SELECT id, name, category_id, price, image, new, short_description FROM product WHERE status = :status AND category_id = :category_id ORDER BY id DESC';
        $stmt = $db->prepare( $query );
        $stmt->bindParam( ':status', self::$status );
        $stmt->bindParam( ':category_id', self::$category_id );
        //$stmt->bindParam( ':count', $count, PDO::PARAM_INT );
        $stmt->execute();
        if ( $stmt->rowCount() > 0 )
        {
            while ( $row = $stmt->fetch() )
            {
                self::$latestProducts[] = $row;
            }
            return self::$latestProducts;
        }
        return self::$latestProducts[] = FALSE;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 18-Nov-19
 * Time: 20:19
 */

namespace models;

use components\Db;
use components\Pagination;
use PDO;

class CatalogModel
{

    private static array $filename;
    private static array $param;
    private static array $categoriesList;
    private static array $latestProducts;
    private static int $status = 1;
    private static int $category_id = 0;
    private static int $page;
    private static string $html;
    const SHOW_BY_PRODUCTS = 6;
    private static object $db;

    public static function getCatalogPage()
    {
        self::$db = Db::getConnection();
        return self::$filename = ['head', 'nav', 'catalog', 'catalog_menu', 'product', 'pagination', 'footer'];
    }

    public static function getParam()
    {
        return self::$param =
            [
                'categoriesList' => self::$categoriesList,
                'latestProducts' => self::$latestProducts,
                'id' => 0,
                'pagination' => self::$html,
                'title' => 'Каталог',
                'name' => 'Каталог сейчас недоступен!',
                'category' => self::$category_id,
                'catalog' => 'active',
                'script' => 'wb'
            ];
    }

    /**
     * @return mixed
     */

    public static function getCategoriesList()
    {
        //$db = Db::getConnection();

        $query = 'SELECT id, name, category FROM category WHERE status = :status ORDER BY category ASC';
        $stmt = self::$db->prepare( $query );
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

    public static function getLatestProducts( $page )
    {
        self::$page = $page;
        $offset = ( self::$page - 1 ) * self::SHOW_BY_PRODUCTS;
        $count = self::SHOW_BY_PRODUCTS;
        //$db = Db::getConnection();

        $query = 'SELECT id, name, price, image, new, short_description FROM product WHERE status = :status ORDER BY id DESC LIMIT :count OFFSET :offset';
        $stmt = self::$db->prepare( $query );
        $stmt->bindParam( ':status', self::$status );
        $stmt->bindParam( ':count', $count, PDO::PARAM_INT );
        $stmt->bindParam( ':offset', $offset, PDO::PARAM_INT );
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

    public static function getProductsByCategory( $category, $page )
    {
        self::$category_id = $category;
        self::$page = $page;
        $offset = ( self::$page - 1 ) * self::SHOW_BY_PRODUCTS;
        $count = self::SHOW_BY_PRODUCTS;

        //$db = Db::getConnection();

        $query = 'SELECT id, name, category_id, price, image, new, short_description FROM product WHERE status = :status AND category_id = :category_id ORDER BY id DESC LIMIT :count OFFSET :offset';
        $stmt = self::$db->prepare( $query );
        $stmt->bindParam( ':status', self::$status );
        $stmt->bindParam( ':category_id', self::$category_id );
        $stmt->bindParam( ':count', $count, PDO::PARAM_INT );
        $stmt->bindParam( ':offset', $offset, PDO::PARAM_INT );
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

    public static function getTotalProductsInProducts()
    {
        //$db = Db::getConnection();

        $query = 'SELECT id FROM product WHERE status = :status';
        $stmt = self::$db->prepare( $query );
        $stmt->bindParam( ':status', self::$status );
        $stmt->execute();
        $total = $stmt->rowCount();

        $pagination = new Pagination( $total, self::$page, self::SHOW_BY_PRODUCTS, 'p' );
        self::$html = $pagination->get();
    }

    public static function getTotalProductsInCategory()
    {
        //$db = Db::getConnection();

        $query = 'SELECT id FROM product WHERE status = :status AND category_id = :category_id';
        $stmt = self::$db->prepare( $query );
        $stmt->bindParam( ':status', self::$status );
        $stmt->bindParam( ':category_id', self::$category_id );
        $stmt->execute();
        $total = $stmt->rowCount();

        $pagination = new Pagination( $total, self::$page, self::SHOW_BY_PRODUCTS, 'p' );
        self::$html = $pagination->get();
    }
}

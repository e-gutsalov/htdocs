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
    private static array $param;
    private static array $categoriesList;
    private static array $latestProducts;
    private static array $CountProducts;
    private static int $status = 1;
    private static int $category_id = 0;
    private static int $page;
    private static string $html;
    const SHOW_BY_PRODUCTS = 6;

    public static function getParam()
    {
        return self::$param =
            [
                'filename' => [ 'head', 'nav', 'catalog.tpl/catalog', 'catalog.tpl/catalog_menu', 'catalog.tpl/product', 'catalog.tpl/pagination', 'footer' ],
                'categoriesList' => self::$categoriesList,
                'latestProducts' => self::$latestProducts,
                'count' => self::$CountProducts,
                'pagination' => self::$html,
                'title' => 'Каталог',
                'name' => 'Каталог сейчас недоступен!',
                'category' => self::$category_id,
                'catalog' => 'active',
                'script' => 'handi',
                'sess' => $_SESSION
            ];
    }

    /**
     * Возвращает список категорий товаров
     * @return mixed
     */

    public static function getCategoriesList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        $query = 'SELECT id, name, category FROM category WHERE status = :status ORDER BY category ASC';
        $stmt = $db->prepare( $query );
        $stmt->bindParam( ':status', self::$status );
        $stmt->execute();
        if ( $stmt->rowCount() > 0 ) {
            while ( $row = $stmt->fetch() ) {
                self::$categoriesList[] = $row;
            }
            return self::$categoriesList;
        }
        return self::$categoriesList[] = FALSE;
    }

    /**
     * Возвращает информацию о товарах
     * Постраничный вывод всех товаров
     * @param $page
     * @return array|bool
     */
    public static function getLatestProducts( $page )
    {
        // Соединение с БД
        $db = Db::getConnection();

        self::$page = $page;
        $offset = ( self::$page - 1 ) * self::SHOW_BY_PRODUCTS;
        $count = self::SHOW_BY_PRODUCTS;

        $query = "SELECT product.id, product.name, product.code, product.price, product.new, product.short_description, images.image1
                  FROM handicrafts.product
                  JOIN handicrafts.images ON images.code = product.code
                  WHERE status = :status ORDER BY id DESC LIMIT :count OFFSET :offset";
        $stmt = $db->prepare( $query );
        $stmt->bindParam( ':status', self::$status );
        $stmt->bindParam( ':count', $count, PDO::PARAM_INT );
        $stmt->bindParam( ':offset', $offset, PDO::PARAM_INT );
        $stmt->execute();
        if ( $stmt->rowCount() > 0 ) {
            while ( $row = $stmt->fetch() ) {
                self::$latestProducts[] = $row;
            }
            return self::$latestProducts;
        }
        return self::$latestProducts[] = FALSE;
    }

    /**
     * Возвращает информацию о товарах
     * Постраничный вывод товаров по категории
     * @param $category
     * @param $page
     * @return array|bool
     */
    public static function getProductsByCategory( $category, $page )
    {
        // Соединение с БД
        $db = Db::getConnection();

        self::$category_id = $category;
        self::$page = $page;
        $offset = ( self::$page - 1 ) * self::SHOW_BY_PRODUCTS;
        $count = self::SHOW_BY_PRODUCTS;

        $query = 'SELECT product.id, product.name, product.category_id, product.code, product.price, product.new, product.short_description, images.image1
                  FROM handicrafts.product
                  JOIN handicrafts.images ON images.code = product.code
                  WHERE status = :status AND category_id = :category_id ORDER BY code DESC LIMIT :count OFFSET :offset';
        $stmt = $db->prepare( $query );
        $stmt->bindParam( ':status', self::$status );
        $stmt->bindParam( ':category_id', self::$category_id );
        $stmt->bindParam( ':count', $count, PDO::PARAM_INT );
        $stmt->bindParam( ':offset', $offset, PDO::PARAM_INT );
        $stmt->execute();
        if ( $stmt->rowCount() > 0 ) {
            while ( $row = $stmt->fetch() ) {
                self::$latestProducts[] = $row;
            }
            return self::$latestProducts;
        }
        return self::$latestProducts[] = FALSE;
    }

    public static function getTotalProductsInProducts()
    {
        // Соединение с БД
        $db = Db::getConnection();

        $query = 'SELECT id FROM product WHERE status = :status';
        $stmt = $db->prepare( $query );
        $stmt->bindParam( ':status', self::$status );
        $stmt->execute();
        $total = $stmt->rowCount();

        $pagination = new Pagination( $total, self::$page, self::SHOW_BY_PRODUCTS, 'p' );
        self::$html = $pagination->get();
    }

    public static function getTotalProductsInCategory()
    {
        // Соединение с БД
        $db = Db::getConnection();

        $query = 'SELECT id FROM product WHERE status = :status AND category_id = :category_id';
        $stmt = $db->prepare( $query );
        $stmt->bindParam( ':status', self::$status );
        $stmt->bindParam( ':category_id', self::$category_id );
        $stmt->execute();
        $total = $stmt->rowCount();

        $pagination = new Pagination( $total, self::$page, self::SHOW_BY_PRODUCTS, 'p' );
        self::$html = $pagination->get();
    }

    /**
     * Возвращает массив с количеством товаров в категории
     * @return array|bool
     */
    public static function getCountProducts()
    {
        // Соединение с БД
        $db = Db::getConnection();

        $query = "SELECT product.category_id AS 'categoryId', count(product.category_id) AS 'count'
                  FROM category
                  JOIN product ON product.category_id = category.category
                  GROUP BY category_id";
        $stmt = $db->prepare( $query );
        $stmt->execute();
        if ( $stmt->rowCount() > 0 ) {
            while ( $row = $stmt->fetch() ) {
                self::$CountProducts[ $row->categoryId ] = $row;
            }
            return self::$CountProducts;
        }
        return self::$CountProducts[] = FALSE;
    }
}

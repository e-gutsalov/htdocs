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
    private static array $param;
    private static array $categoriesList;
    private static array $latestProducts;
    private static array $ImagesCarousel;
    private static array $CountProducts;
    private static int $status = 1;
    private static int $category_id = 0;
    const SHOW_BY_PRODUCTS = 6;

    public static function getParam()
    {
        return self::$param =
            [
                'filename' => [ 'head', 'nav', 'main.tpl/catalog', 'main.tpl/catalog_menu', 'main.tpl/carousel', 'main.tpl/product', 'footer' ],
                'categoriesList' => self::$categoriesList,
                'latestProducts' => self::$latestProducts,
                'carousel' => self::$ImagesCarousel,
                'count' => self::$CountProducts,
                'title' => 'Главная',
                'name' => 'Каталог сейчас недоступен!',
                'category' => self::$category_id,
                'main' => 'active',
                'script' => 'handi',
                'sess' => $_SESSION
            ];
    }

    /**
     * Возвращает список категорий товаров
     * @return mixed
     */

    public static function getCategoriesList() : array
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
     * @param int $count лимит товаров на странице
     * @return array|bool
     */
    public static function getLatestProducts( $count = self::SHOW_BY_PRODUCTS ) : array
    {
        // Соединение с БД
        $db = Db::getConnection();

        $query = "SELECT product.id, product.name, product.code, product.price, product.new, product.short_description, images.image1
                  FROM handicrafts.product
                  JOIN handicrafts.images ON images.code = product.code
                  WHERE status = :status AND new = 'new' ORDER BY code DESC LIMIT :count";
        $stmt = $db->prepare( $query );
        $stmt->bindParam( ':status', self::$status );
        $stmt->bindParam( ':count', $count, PDO::PARAM_INT );
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
     * Возвращает массив с рекомендованными товарами
     * @return array|bool
     */
    public static function getRecommendedProducts() : array
    {
        // Соединение с БД
        $db = Db::getConnection();

        $query = "SELECT product.id, product.name, product.code, product.new, product.description, product.price, images.image1, images.image2, images.image3, images.image4, images.image5
                  FROM handicrafts.product
                  JOIN handicrafts.images ON images.code = product.code
                  WHERE status = :status AND product.recommended = 1 ORDER BY code DESC";
        $stmt = $db->prepare( $query );
        $stmt->bindParam( ':status', self::$status );
        $stmt->execute();
        if ( $stmt->rowCount() > 0 ) {
            while ( $row = $stmt->fetch() ) {
                self::$ImagesCarousel[] = $row;
            }
            return self::$ImagesCarousel;
        }
        return self::$ImagesCarousel[] = FALSE;
    }

    /**
     * Возвращает массив с количеством товаров в категории
     * @return array|bool
     */
    public static function getCountProducts() : array
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

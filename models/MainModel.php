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
    private static int $status = 1;
    private static int $category_id = 0;
    const SHOW_BY_PRODUCTS = 6;

    public static function getParam()
    {
        return self::$param =
            [
                'categoriesList' => self::$categoriesList,
                'latestProducts' => self::$latestProducts,
                'carousel' => self::$ImagesCarousel,
                'id' => 0,
                'title' => 'Главная',
                'name' => 'Каталог сейчас недоступен!',
                'category' => self::$category_id,
                'main' => 'active',
                'script' => 'handi',
                'sess' => $_SESSION
            ];
    }

    /**
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

    public static function getLatestProducts( $count = self::SHOW_BY_PRODUCTS )
    {
        // Соединение с БД
        $db = Db::getConnection();

        $query = "SELECT id, name, code, price, image, new, short_description FROM product WHERE status = :status AND new = 'new' ORDER BY id DESC LIMIT :count";
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

    public static function getRecommendedProducts()
    {
        // Соединение с БД
        $db = Db::getConnection();

        $query = "SELECT product.id, product.name, product.code, product.new, product.description, product.price, images.image1, images.image2, images.image3, images.image4, images.image5
                    FROM handicrafts.product
                    JOIN handicrafts.images ON images.code = product.code
                    WHERE status = :status AND product.recommended = 1 ORDER BY id DESC";
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

}

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

    private static array $filename;
    private static array $param;
    private static array $categoriesList;
    private static array $latestProducts;
    private static array $ImagesCarousel;
    private static int $status = 1;
    private static int $category_id = 0;
    const SHOW_BY_PRODUCTS = 6;
    private static object $db;

    public static function getMainPage()
    {
        self::$db = Db::getConnection();
        return self::$filename = ['head', 'nav', 'main', 'catalog_menu', 'carousel', 'product', 'footer'];
    }

    public static function getParam()
    {
        return self::$param =
            [
                'categoriesList' => self::$categoriesList,
                'latestProducts' => self::$latestProducts,
                'id' => 0,
                'title' => 'Главная',
                'name' => 'Каталог сейчас недоступен!',
                'category' => self::$category_id,
                'main' => 'active',
                'script' => 'wb',
                'sess' => $_SESSION
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

    public static function getLatestProducts( $count = self::SHOW_BY_PRODUCTS )
    {
        //$db = Db::getConnection();

        $query = 'SELECT id, name, code, price, image, new, short_description FROM product WHERE status = :status ORDER BY id DESC LIMIT :count';
        $stmt = self::$db->prepare( $query );
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

    public static function getImagesCarousel()
    {
        //$db = Db::getConnection();

        //$query = 'SELECT id, name, price, image, new, short_description FROM product WHERE status = :status ORDER BY id DESC';
        $query = "SELECT product.id, product.name, product.code, product.new, product.description, product.price, images.image1, images.image2, images.image3, images.image4, images.image5
                    FROM handicrafts.product
                    JOIN handicrafts.images ON images.code = product.code
                    WHERE status = :status AND product.new = 'new' ORDER BY id DESC";
        $stmt = self::$db->prepare( $query );
        $stmt->bindParam( ':status', self::$status );
        //$stmt->bindParam( ':count', $count, PDO::PARAM_INT );
        $stmt->execute();
        if ( $stmt->rowCount() > 0 )
        {
            while ( $row = $stmt->fetch() )
            {
                self::$ImagesCarousel[] = $row;
            }
            return self::$ImagesCarousel;
        }
        return self::$ImagesCarousel[] = FALSE;
    }

}

<?php


namespace models;


use components\Db;
use PDO;

class ProductModel
{
    private static array $param;
    private static object $ProductDetails;
    private static array $images = [];

    /**
     * @return array
     */
    public static function getParam()
    {
        return self::$param =
            [
                'productDetails' => self::$ProductDetails,
                'images' => self::$images,
                'title' => 'Описание товара',
                'catalogErr' => 'Запрашиваемый товар отсутствует в каталоге!',
                'catalog' => 'active',
                'script' => 'handi',
                'sess' => $_SESSION
            ];
    }

    /**
     * @param null $id
     */
    public static function getProductDetails( $id = NULL )
    {
        // Соединение с БД
        $db = Db::getConnection();

        $query = 'SELECT product.id, product.name, product.code, product.price, product.new, product.description, images.image1, images.image2, images.image3, images.image4, images.image5
                  FROM handicrafts.product
                  JOIN handicrafts.images ON images.code = product.code
                  WHERE product.id = :id';
        $stmt = $db->prepare( $query );
        $stmt->bindParam( ':id', $id, PDO::PARAM_INT );
        $stmt->execute();
        if ( $stmt->rowCount() > 0 ) {
            self::$ProductDetails = $stmt->fetch();
            self::$images = [ self::$ProductDetails->image1, self::$ProductDetails->image2, self::$ProductDetails->image3, self::$ProductDetails->image4, self::$ProductDetails->image5 ];
        } else {
            self::$ProductDetails = new \stdClass();
        }
    }
}

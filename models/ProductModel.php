<?php


namespace models;


use components\Db;
use PDO;

class ProductModel
{
    private static array $param;
    private static array $ProductDetails;

    public static function getParam()
    {
        return self::$param =
            [
                'productDetails' => self::$ProductDetails,
                'id' => 0,
                'title' => 'Описание товара',
                'name' => 'Каталог сейчас недоступен!',
                'catalog' => 'active',
                'script' => 'handi',
                'sess' => $_SESSION
            ];
    }

    public static function getProductDetails( $id = NULL )
    {
        // Соединение с БД
        $db = Db::getConnection();

        $query = 'SELECT product.id, product.name, product.code, price, new, description, image1, image2, image3, image4, image5
                    FROM handicrafts.product
                        JOIN handicrafts.images ON images.code = product.code
                    WHERE product.id = :id';
        $stmt = $db->prepare( $query );
        $stmt->bindParam( ':id', $id, PDO::PARAM_INT );
        $stmt->execute();
        if ( $stmt->rowCount() > 0 )
        {
            while ( $row = $stmt->fetch() )
            {
                self::$ProductDetails[] = $row;
            }
            return self::$ProductDetails;
        }
        return self::$ProductDetails[] = FALSE;
    }

}

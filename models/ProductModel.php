<?php


namespace models;


use components\Db;
use PDO;

class ProductModel
{

    private static array $filename;
    private static array $param;
    private static array $ProductDetails;

    public static function getProductPage()
    {
        return self::$filename = ['head', 'nav', 'product_details', 'footer'];
    }

    public static function getParam()
    {
        return self::$param =
            [
                'productDetails' => self::$ProductDetails,
                'id' => 0,
                'title' => 'Описание товара',
                'name' => 'Каталог сейчас недоступен!',
                'catalog' => 'active',
                'script' => 'wb'
            ];
    }

    public static function getProductDetails( $id = NULL )
    {
        $db = Db::getConnection();

        /*$query = 'SELECT id, name, code, price, image, new, description FROM product WHERE id = :id';*/
        $query = 'SELECT product.id, product.name, product.code, price, new, description, image1, image2, image3, image4, image5
                    FROM handicrafts.product
                        JOIN handicrafts.images ON images.code = product.code
                    WHERE product.id = :id';
        $stmt = $db->prepare( $query );
        $stmt->bindParam( ':id', $id, PDO::PARAM_INT );
        //$stmt->bindParam( ':count', $id, PDO::PARAM_INT );
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

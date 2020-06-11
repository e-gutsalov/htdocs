<?php


namespace models;


use components\Db;

class AdminProductModel
{
    private static array $param;
    private static array $productsList = [];

    public static function getParam()
    {
        return self::$param =
            [
                'productsList' => self::$productsList,
                'id' => 0,
                'title' => 'Админпанель',
                'name' => 'Каталог сейчас недоступен!',
                'admin' => 'active',
                'script' => 'handi',
                'sess' => $_SESSION
            ];
    }

    /**
     * Возвращает список товаров
     * @return void <p>Массив с товарами</p>
     */
    public static function getProductsList() : void
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
//        $sql = 'SELECT product.id, product.name, product.code, product.new, product.description, product.price, images.image1, images.image2, images.image3, images.image4, images.image5
//                FROM handicrafts.product
//                JOIN handicrafts.images ON images.code = product.code';
        $sql = 'SELECT id, name, price, code FROM product ORDER BY id ASC';
        $stmt = $db->prepare( $sql );
        $stmt->execute();

        if ( $stmt->rowCount() > 0 ) {
            while ( $row = $stmt->fetch() ) {
                self::$productsList[] = $row;
            }
        }
    }
}

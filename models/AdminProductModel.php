<?php


namespace models;


use components\Db;
use PDO;

class AdminProductModel
{
    private static array $param;
    private static array $productsList = [];
    private static int $id = 0;
    private static string $page;

    public static function getParam()
    {
        return self::$param =
            [
                'filename' => [ 'head', 'admin.tpl/header_admin', self::$page, 'admin.tpl/footer_admin', 'footer' ],
                'productsList' => self::$productsList,
                'id' => self::$id,
                'title' => 'Админпанель',
                'name' => 'Каталог сейчас недоступен!',
                'admin' => 'active',
                'script' => 'handi'
            ];
    }

    /**
     * Возвращает список товаров
     * @return void <p>Массив с товарами</p>
     */
    public static function getProductsList() : void
    {
        self::$page = 'admin.tpl/product_admin';

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

    /**
     * Удаляет товар с указанным id
     * @param integer $id <p>id товара</p>
     * @return void <p>Результат выполнения метода</p>
     */
    public static function deleteProductById( int $id ) : void
    {
        self::$id = $id;
        self::$page = 'admin.tpl/delete';

        // Обработка формы
        if ( isset( $_POST[ 'submit' ] ) ) {
            // Если форма отправлена
            // Удаляем товар

            // Соединение с БД
            $db = Db::getConnection();

            // Текст запроса к БД
            $sql = 'DELETE FROM product WHERE id = :id';

            // Получение и возврат результатов. Используется подготовленный запрос
            $result = $db->prepare( $sql );
            $result->bindParam( ':id', self::$id, PDO::PARAM_INT );
            $result->execute();

            // Перенаправляем пользователя на страницу управлениями товарами
            header( "Location: /admin/product" );
        }
    }
}

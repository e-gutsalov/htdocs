<?php
/**
 * Класс Order - модель для работы с заказами
 */

namespace models;


use components\Db;
use PDO;

class OrderModel
{
    private static array $ordersList;

    /**
     * Сохранение заказа
     * @param integer $userId <p>id пользователя</p>
     * @param string $userName <p>Имя</p>
     * @param string $userPhone <p>Телефон</p>
     * @param string $userAddress <p>Адрес</p>
     * @param string $userComment <p>Комментарий</p>
     * @param array $products <p>Массив с товарами</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function save( $userId, $userName, $userAddress, $userPhone, $userComment, $products )
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO customers ( user_id, name, address, phone, comment ) VALUES ( :user_id, :user_name, :user_address, :user_phone, :user_comment );
                INSERT INTO orders ( customers_id, products ) VALUES ( LAST_INSERT_ID(), :products );';

        $products = json_encode( $products );

        $result = $db->prepare( $sql );
        $result->bindParam( ':user_id', $userId, PDO::PARAM_INT );
        $result->bindParam( ':user_name', $userName, PDO::PARAM_STR );
        $result->bindParam( ':user_address', $userAddress, PDO::PARAM_STR );
        $result->bindParam( ':user_phone', $userPhone, PDO::PARAM_STR );
        $result->bindParam( ':user_comment', $userComment, PDO::PARAM_STR );
        $result->bindParam( ':products', $products, PDO::PARAM_STR );

        return $result->execute();
    }

    /**
     * Возвращает список заказов
     * @param int $user_id
     * @return array|bool <p>Список заказов</p>
     */
    public static function getOrdersList( int $user_id )
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        // Текст запроса к БД
        $sql = 'SELECT id, customers_id, date, products, status FROM orders WHERE customers_id = :customers_id ORDER BY id DESC';
        $stmt = $db->prepare( $sql );
        $stmt->bindParam( ':user_id', $user_id, PDO::PARAM_INT );
        $stmt->execute();

        if ( $stmt->rowCount() > 0 ) {
            while ( $row = $stmt->fetch() ) {
                self::$ordersList[] = $row;
            }
            return self::$ordersList;
        }
        return self::$ordersList[] = FALSE;
    }
}

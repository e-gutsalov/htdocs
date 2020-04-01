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

class CartModel
{
    private static array $filename;
    private static array $param;
    private static array $products;
    private static int $status = 1;
    private static object $db;

    public static function getCartPage()
    {
        self::$db = Db::getConnection();
        return self::$filename = ['head', 'nav', 'cart', 'footer'];
    }

    public static function getParam()
    {
        return self::$param =
            [
                'id' => 0,
                'title' => 'Корзина',
                'cart' => 'active',
                'script' => 'wb',
                'sess' => $_SESSION
            ];
    }

    /**
     * Action для страницы "Корзина"
     */
    public static function showCart()
    {
        // Получим идентификаторы и количество товаров в корзине
        $productsInCart = CartModel::getProducts();

        if ( $productsInCart ) {
            // Если в корзине есть товары, получаем полную информацию о товарах для списка
            // Получаем массив только с идентификаторами товаров
            $productsIds = array_keys( $productsInCart );

            // Получаем массив с полной информацией о необходимых товарах
            $products = CartModel::getProdustsByIds( $productsIds );

            // Получаем общую стоимость товаров
            $_SESSION['cart']['totalPrice']  = CartModel::getTotalPrice( $products );
        }
    }

    /**
     * Добавление товара в корзину (сессию)
     * @param int $id <p>id товара</p>
     * @return integer <p>Количество товаров в корзине</p>
     */
    public static function addProduct( $id )
    {
        // Приводим $id к типу integer
        $id = intval( $id );

        // Пустой массив для товаров в корзине
        $productsInCart = [];

        // Если в корзине уже есть товары (они хранятся в сессии)
        if ( isset( $_SESSION['cart']['products'] ) ) {
            // То заполним наш массив товарами
            $productsInCart = $_SESSION['cart']['products'];
        }

        // Проверяем есть ли уже такой товар в корзине
        if ( array_key_exists( $id, $productsInCart ) ) {
            // Если такой товар есть в корзине, но был добавлен еще раз, увеличим количество на 1
            $productsInCart[$id]++;
        } else {
            // Если нет, добавляем id нового товара в корзину с количеством 1
            $productsInCart[$id] = 1;
        }

        // Записываем массив с товарами в сессию
        $_SESSION['cart']['products'] = $productsInCart;
        $_SESSION['cart']['count'] = self::countItems();

        // Возвращаем количество товаров в корзине
        return self::countItems();
    }

    /**
     * Подсчет количество товаров в корзине (в сессии)
     * @return int <p>Количество товаров в корзине</p>
     */
    public static function countItems()
    {
        //$count = 0;
        // Проверка наличия товаров в корзине
        if ( isset( $_SESSION['cart']['products'] ) ) {
            // Если массив с товарами есть
            // Подсчитаем и вернем их количество
            /*foreach ( $_SESSION['cart']['products'] as $id => $quantity ) {
                $count = $count + $quantity;
            }*/
            return array_sum( $_SESSION['cart']['products'] );
        } else {
            // Если товаров нет, вернем 0
            return 0;
        }
    }

    /**
     * Возвращает массив с идентификаторами и количеством товаров в корзине<br/>
     * Если товаров нет, возвращает false;
     * @return mixed: boolean or array
     */
    public static function getProducts()
    {
        if ( isset( $_SESSION['cart']['products'] ) ) {
            return $_SESSION['cart']['products'];
        }
        return false;
    }

    /**
     * Возвращает список товаров с указанными индентификторами
     * @param array $idsArray <p>Массив с идентификаторами</p>
     * @return array <p>Массив со списком товаров</p>
     */
    public static function getProdustsByIds( $idsArray )
    {
        // Превращаем массив в строку для формирования условия в запросе
        $idsString = implode( ',', $idsArray );

        //$query = 'SELECT * FROM product WHERE status = :status AND id IN ( :idsString )';
        $query = "SELECT * FROM product WHERE status = :status AND id IN ( $idsString )";
        $stmt = self::$db->prepare( $query );
        $stmt->bindParam( ':status', self::$status, PDO::PARAM_INT );
        //$stmt->bindParam( ':idsString', $idsString, PDO::PARAM_STR );
        $stmt->execute();

        // Получение и возврат результатов
        //$i = 0;
        while ( $row = $stmt->fetch() )
        {
            $_SESSION['cart']['inCart'][$row->code] = $row;
            //$i++;
        }
        return $_SESSION['cart']['inCart'];
    }

    /**
     * Получаем общую стоимость переданных товаров
     * @param array $products <p>Массив с информацией о товарах</p>
     * @return integer <p>Общая стоимость</p>
     */
    public static function getTotalPrice( $products )
    {
        // Получаем массив с идентификаторами и количеством товаров в корзине
        $productsInCart = self::getProducts();

        // Подсчитываем общую стоимость
        $total = 0;
        if ( $productsInCart ) {
            // Если в корзине не пусто
            // Проходим по переданному в метод массиву товаров
            foreach ( $products as $item ) {
                // Находим общую стоимость: цена товара * количество товара
                $total += $item->price * $productsInCart[$item->code];
            }
        }
        return $total;
    }

    /**
     * Удаляет товар с указанным id из корзины
     * @param integer $id <p>id товара</p>
     * @return integer <p>Общая стоимость</p>
     */
    public static function deleteProduct( $id )
    {
        // Получаем массив с идентификаторами и количеством товаров в корзине
        $productsInCart = self::getProducts();

        // Удаляем из массива элемент с указанным id
        unset( $productsInCart[$id] );

        // Записываем массив товаров с удаленным элементом в сессию
        $_SESSION['cart']['products'] = $productsInCart;
        $_SESSION['cart']['count'] = self::countItems();
        unset( $_SESSION['cart']['inCart'][$id] );
        $_SESSION['cart']['totalPrice'] = CartModel::getTotalPrice( $_SESSION['cart']['inCart'] );
        return json_encode( ['count' => $_SESSION['cart']['count'], 'totalPrice' => $_SESSION['cart']['totalPrice']] );
    }
}

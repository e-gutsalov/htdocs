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
    private static array $categoriesList;
    private static array $latestProducts;
    private static int $status = 1;
    private static int $category_id = 0;
    const SHOW_BY_PRODUCTS = 6;
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
                'name' => 'Каталог сейчас недоступен!',
                'cart' => 'active',
                'script' => 'wb',
                'sess' => $_SESSION
            ];
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
        // Проверка наличия товаров в корзине
        if ( isset( $_SESSION['cart']['products'] ) ) {
            // Если массив с товарами есть
            // Подсчитаем и вернем их количество
            $count = 0;
            foreach ( $_SESSION['cart']['products'] as $id => $quantity ) {
                $count = $count + $quantity;
            }
            return $count;
        } else {
            // Если товаров нет, вернем 0
            return 0;
        }
    }

}

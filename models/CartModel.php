<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 03-Mar-19
 * Time: 23:14
 */

namespace models;

use components\Cart;

class CartModel
{
    private static array $param;
    private static string $page = '';
    public static object $cartProcess;

    public static function getParam()
    {
        return self::$param =
            [
                'page' => [ 'head', 'nav', 'cart.tpl/' . self::$page, 'footer' ],
                'title' => 'Корзина',
                'cart' => 'active',
                'script' => 'handi',
                'cartProcess' => self::$cartProcess,
                'sess' => $_SESSION
            ];
    }

    /**
     * Action для страницы "Корзина"
     */
    public static function showCart()
    {
        self::$page = 'cart';
        self::$cartProcess = new Cart();
        self::$cartProcess->showCartProcess();
    }

    /**
     * Добавление товара в корзину (сессию)
     * @param int $code <p>code товара</p>
     * @return integer <p>Количество товаров в корзине</p>
     */
    public static function addProduct( int $code )
    {
        self::$cartProcess = new Cart();
        return self::$cartProcess->addProductProcess( $code );
    }

    /**
     * Удаляет товар с указанным code из корзины
     * @param integer $code <p>code товара</p>
     * @return string <p>Возвращает JSON объект</p>
     */
    public static function deleteProduct( int $code )
    {
        self::$cartProcess = new Cart();
        return self::$cartProcess->deleteProductProcess( $code );
    }

    /**
     * Action для страницы "Оформление покупки"
     */
    public static function checkoutProducts()
    {
        self::$page = 'checkout';
        self::$cartProcess = new Cart();
        self::$cartProcess->checkoutProductsProcess();
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 12-Feb-19
 * Time: 23:44
 */

namespace controllers;

use models\CartModel;
use views\CartView;

class CartController
{
    public function actionCart()
    {
        $filename = CartModel::getCartPage();
        CartModel::showCart();
        $param = CartModel::getParam();
        CartView::getView( $filename, $param );
        //var_dump($_SESSION);
    }

    /**
     * Action для добавления товара в корзину при помощи асинхронного запроса (ajax)
     * @param integer $id <p>id товара</p>
     */
    public function actionAdd( int $id )
    {
        // Добавляем товар в корзину и выводим результат: количество товаров в корзине
        echo CartModel::addProduct( $id );
        //return true;
    }

    /**
     * Удаляет товар с указанным id из корзины
     * @param integer $id <p>id товара</p>
     */
    public function actionDelete( $id )
    {
        // Удаляем заданный товар из корзины
        echo CartModel::deleteProduct( $id );

        // Возвращаем пользователя в корзину
        //header("Location: /cart");
    }
}

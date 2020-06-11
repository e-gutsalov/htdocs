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
        CartModel::showCart();
        $param = CartModel::getParam();
        CartView::getView( $param );
    }

    /**
     * Action для добавления товара в корзину при помощи асинхронного запроса (ajax)
     * @param integer $code <p>id товара</p>
     */
    public function actionAdd( int $code )
    {
        // Добавляем товар в корзину и выводим результат: количество товаров в корзине
        echo CartModel::addProduct( $code );
    }

    /**
     * Удаляет товар с указанным id из корзины
     * @param integer $code <p>id товара</p>
     */
    public function actionDelete( $code )
    {
        // Удаляем заданный товар из корзины
        echo CartModel::deleteProduct( $code );
    }

    /**
     * Action для страницы "Оформление покупки"
     */
    public function actionCheckout()
    {
        CartModel::checkoutProducts();
        $param = CartModel::getParam();
        CartView::getView( $param );
    }
}

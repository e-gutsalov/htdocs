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

    /**
     * Action для добавления товара в корзину при помощи асинхронного запроса (ajax)
     * @param integer $id <p>id товара</p>
     */
    public function actionAdd( $id )
    {
        // Добавляем товар в корзину и выводим результат: количество товаров в корзине
        echo CartModel::addProduct( $id );
        //return true;
    }

    public function actionCart()
    {
        $filename = CartModel::getCartPage();
        $param = CartModel::getParam();
        CartView::getView( $filename, $param );
    }

}

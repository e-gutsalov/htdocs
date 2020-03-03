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
        $param = CartModel::getParam();
        CartView::getView( $filename, $param );
    }
}

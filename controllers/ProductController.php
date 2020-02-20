<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 12-Feb-19
 * Time: 22:21
 */

namespace controllers;

use models\ProductModel;
use views\ProductView;

class ProductController
{

    public function actionProduct( $id = NULL )
    {
        $filename = ProductModel::getProductPage();
        ProductModel::getProductDetails( $id );
        $param = ProductModel::getParam();
        ProductView::getView( $filename, $param );
    }

}

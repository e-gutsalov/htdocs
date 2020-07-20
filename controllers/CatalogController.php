<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 18-Nov-19
 * Time: 20:17
 */

namespace controllers;

use models\CatalogModel;
use views\CatalogView;

class CatalogController
{
    public function actionCatalog( int $page = 1 )
    {
        CatalogModel::getCategoriesList();
        CatalogModel::getLatestProducts( $page );
        CatalogModel::getCountProducts();
        CatalogModel::getTotalProductsInProducts();
        $param = CatalogModel::getParam();
        CatalogView::getView( $param );
    }

    public function actionCategory( int $category = NULL, int $page = 1 )
    {
        CatalogModel::getCategoriesList();
        CatalogModel::getProductsByCategory( $category, $page );
        CatalogModel::getCountProducts();
        CatalogModel::getTotalProductsInCategory();
        $param = CatalogModel::getParam();
        CatalogView::getView( $param );
    }
}

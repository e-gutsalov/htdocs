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
    public function actionCatalog()
    {
        $filename = CatalogModel::getCatalogPage();
        CatalogModel::getCategoriesList();
        CatalogModel::getLatestProducts();
        $param = CatalogModel::getParam();
        CatalogView::getView( $filename, $param );
    }

    public function actionCategory( $category = NULL )
    {
        $filename = CatalogModel::getCatalogPage();
        CatalogModel::getCategoriesList();
        CatalogModel::getProductsByCategory( $category );
        $param = CatalogModel::getParam();
        CatalogView::getView( $filename, $param );
    }
}

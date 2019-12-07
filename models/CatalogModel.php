<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 18-Nov-19
 * Time: 20:19
 */

namespace models;

use components\Db;

class CatalogModel
{
    private static string $title = 'Каталог';
    private static string $cat = 'catalog';
    private static array $filename;
    private static array $param;
    private static array $categoriesList;
    private static int $status = 1;

    public static function getCatalog()
    {
        return self::$filename = ['head', 'nav', 'catalog', 'catalog_menu', 'product', 'footer'];
    }

    public static function getParam()
    {
        self::getCategoriesList();

        return self::$param =
            [
                'categoriesList' => self::$categoriesList,
                'catalog_menu' => ['page' => 'catalog_menu', 'strButton' => 6],
                'catalog' => 'active',
                'script' => 'wb'
            ];
    }

    /**
     * @return mixed
     */

    public static function getCategoriesList()
    {
        $db = Db::getConnection();
        $query = 'SELECT id, name FROM category WHERE status = :status ORDER BY category ASC';
        $stmt = $db->prepare( $query );
        $stmt->bindParam( ':status', self::$status );
        $stmt->execute();
        if ( $stmt->rowCount() > 1 )
        {
            while ( $row = $stmt->fetch() )
            {
                self::$categoriesList[] = $row;
            }
            return self::$categoriesList;
        }
        return false;
    }
}

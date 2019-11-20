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
    public static $title = 'Каталог';
    public static $cat = 'catalog';
    public static $result;
    public static $status = 1;

    public static function getCatalog()
    {
        return $filename = ['head', 'nav', 'catalog', 'footer'];
    }

    public static function getParam()
    {
        return $param = ['catalog' => 'active', 'script' => 'wb-chart'];
    }

    public static function getCategory()
    {
        $db = Db::getConnection();
        $query = 'SELECT * FROM category WHERE status = :status';
        $stmt = $db->prepare( $query );
        $stmt->bindParam(':status', self::$status );
        $stmt->execute();
        if ( $stmt->rowCount() > 1)
        {
            while ( $row = $stmt->fetch() )
            {
                self::$result[] = $row;
            }
            return self::$result;
        }
        return false;
    }
}

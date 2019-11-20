<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 17-Feb-19
 * Time: 01:45
 */

namespace components;

use PDO;
use PDOException;

class Db
{
    /*private static $paramsPath,
                   $params,
                   $dsn,
                   $db;

    public function __construct()
    {
        $paramsPath = 'config/db_params.php';
        $params = require $paramsPath;
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
    }
*/

    public static function getConnection()
    {
        $paramsPath = 'config/db_params.php';
        $params = require $paramsPath;
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try
        {
            $db = new PDO( $dsn, $params['user'], $params['password'], $options );
        }
        catch ( PDOException $e )
        {
            echo 'Ошибка: ' . $e->getMessage();
            exit();
        }
        return $db;
    }
}

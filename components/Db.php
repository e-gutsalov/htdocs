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
    private static object $db;

    public function __construct()
    {
    }

    public function __clone()
    {
    }

    /**
     * @return PDO
     */

    public static function getConnection()
    {
        $params = require 'config/db_params.php';
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $options = [
            //PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'
        ];

        try {
            self::$db = new PDO( $dsn, $params[ 'user' ], $params[ 'password' ], $options );
        } catch ( PDOException $e ) {
            echo 'Ошибка подключения к базе данных: ' . $e->getMessage();
            exit();
        }
        return self::$db;
    }
}

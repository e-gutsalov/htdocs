<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 20-Jan-19
 * Time: 23:50
 * Front Controller
 */

use components\Router;
use components\DB;

//define('ROOT', dirname(__FILE__));
define('ROOT', __DIR__);
require 'config/autoload.php';

try {
$router = new Router();
$router->run();
} catch (Exception $e) {
    echo $e->getMessage(), '\n';
}

new DB();

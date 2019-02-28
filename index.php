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

spl_autoload_register();

/*ini_set('display_errors', 1);
error_reporting(E_ALL);*/

//define('ROOT', dirname(__FILE__));
//include (ROOT.'/components/Router.php');

try {
$router = new Router();
$router->run();
} catch (Exception $e) {
    echo $e->getMessage(), '\n';
}

new DB();

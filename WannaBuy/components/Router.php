<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 10-Feb-19
 * Time: 01:20
 */

namespace components;

//use \controllers;
use \Exception;

spl_autoload_register(function ($controllerName) {
    $controllerFile = ROOT . '/controllers/' . str_replace('\\', '/', $controllerName) . '.php';
    if (file_exists($controllerFile)) {
        include ($controllerFile);
    } else {
        throw new Exception("Невозможно загрузить $controllerFile.");
    }

});

class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include ($routesPath);
    }

    /**
     * Получаем строку запроса
     * @return string
     */
    private function getURI ()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            $uri = trim($_SERVER['REQUEST_URI'], '/');
        }
        return $uri;

    }

    public function run()
    {
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("#$uriPattern#", $uri)) {

                $internalRoute = preg_replace("#$uriPattern#", $path, $uri);

                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action' . ucfirst(array_shift($segments));

                try {
                    $controllerObject = new $controllerName;
                } catch (Exception $e) {
                    echo $e->getMessage(), "\n";
                }

                //$result = $controllerObject->$actionName($segments);
                $result = call_user_func_array(array($controllerObject, $actionName), $segments);

                if ($result) {
                    break;
                }

            }
        }
    }

}
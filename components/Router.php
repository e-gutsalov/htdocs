<?php
/**
 * Created by PhpStorm.
 * User: egutsalov
 * Date: 10-Feb-19
 * Time: 01:20
 */

namespace components;

use controllers\MainController;
use Exception;

class Router
{
    private array $routes;
    private string $uri;

    public function __construct()
    {
        $this->routes = require 'config/routes.php';
    }

    /**
     * Получаем строку запроса
     * @return string
     */
    private function getURI()
    {
        if ( !empty( $_SERVER[ 'REQUEST_URI' ] ) ) {
            $this->uri = trim( $_SERVER[ 'REQUEST_URI' ], '/' );
        }
        return $this->uri;
    }

    public function run()
    {
        $uri = $this->getURI();

        foreach ( $this->routes as $uriPattern => $path ) {
            if ( preg_match( "#^$uriPattern$#", $uri ) ) {
                $internalRoute = preg_replace( "#$uriPattern#", $path, $uri );
                $segments = explode( '/', $internalRoute );
                $controllerName = 'controllers\\' . ucfirst( array_shift( $segments ) . 'Controller' );
                $actionName = 'action' . ucfirst( array_shift( $segments ) );

                try {
                    $controllerObject = new $controllerName;
                } catch ( Exception $e ) {
                    echo $e->getMessage(), '\n';
                }

                call_user_func_array( array( $controllerObject, $actionName ), $segments );
                exit();
            }
        }

        //header("Location: /");

        try {
            $controllerObject = new MainController();
        } catch ( Exception $e ) {
            echo $e->getMessage(), '\n';
        }

        call_user_func( array( $controllerObject, 'actionMain' ) );
        exit();
    }
}

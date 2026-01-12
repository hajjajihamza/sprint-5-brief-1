<?php

namespace App\Router;

class Router
{
    public static array $routes = [];
    
    public static function get(string $path, mixed $action): void
    {
        self::$routes['GET'] = new Route( $path, $action);
    }

    public static function post(string $path, mixed $action): void
    {
        self::$routes['POST'] = new Route( $path, $action);
    }

    public static function put(string $path, mixed $action): void
    {
        self::$routes['PUT'] = new Route( $path, $action);
    }

    public static function patch(string $path, mixed $action): void
    {
        self::$routes['PATCH'] = new Route( $path, $action);
    }

    public static function delete(string $path, mixed $action): void
    {
        self::$routes['DELETE'] = new Route( $path, $action);
    }

    public static function resolve(string $method, string $path): void
    {
        if (isset(self::$routes[$method][$path])) {
            $route = self::$routes[$method][$path];
            if (is_array($route->action)) {
                [$controller, $method] = $route->action;
                $controller = new $controller();
                $controller->$method();
            } else {
                $route->action();
            }
        }
    }
}
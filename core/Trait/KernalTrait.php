<?php

namespace Core\Trait;

use Core\Http\Request;
use Core\Http\Response;
use Core\Router\Router;

trait KernalTrait
{
    public function run(): void
    {
        $request = Request::capture();

        $routesFile = dirname(__DIR__, 2) . '/route/web.php';
        if (file_exists($routesFile)) {
            require_once $routesFile;
        }

        $method = $request->getMethod();
        $path = $request->getPath();

        $route = Router::resolve($method, $path);

        if (!$route) {
            new Response('404 Not Found', 404)->send();
            return;
        }

        $action = $route->getAction();
        [$controllerClass, $methodName] = $action;

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            if (method_exists($controller, $methodName)) {
                // Check if the method expects parameters
                $reflection = new \ReflectionMethod($controller, $methodName);

                if ($reflection->getReturnType()?->getName() !== Response::class) {
                    throw new \RuntimeException('The method must return a Response object');
                }

                $args = [];
                if ($reflection->getNumberOfParameters() > 0) {
                    $args[] = $request;
                }

                $response = $controller->$methodName(...$args);

                $response->send();
            } else {
                new Response("Method $methodName not found in $controllerClass", 500)->send();
            }
        } else {
            new Response("Controller $controllerClass not found", 500)->send();
        }
    }
}
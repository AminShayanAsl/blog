<?php

namespace App;

class Router
{
    private $routes = [];

    public function get($path, $controller, $method)
    {
        return $this->addRoute('GET', $path, $controller, $method);
    }

    public function post($path, $controller, $method)
    {
        return $this->addRoute('POST', $path, $controller, $method);
    }

    private function addRoute($method, $path, $controller, $action)
    {
        $this->routes[$method][$path] = [
            'controller' => $controller,
            'method' => $action,
            'middleware' => []
        ];
        return $this;
    }

    public function addMiddleware($middleware)
    {
        $lastMethod = array_key_last($this->routes);
        $lastRoute = array_key_last($this->routes[$lastMethod]);

        $this->routes[$lastMethod][$lastRoute]['middleware'][] = $middleware;
        return $this;
    }

    public function dispatch()
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $method =  $_SERVER['REQUEST_METHOD'];
        if (isset($this->routes[$method][$uri])) {
            $route = $this->routes[$method][$uri];

            foreach ($route['middleware'] as $middleware) {
                if (!$middleware->handle()) {
                    echo "401 - You do not have access to this url";
                    return;
                }
            }

            $controller = new $route['controller']();
            call_user_func([$controller, $route['method']]);
        } else {
            http_response_code(404);
            echo "404 - Not Found";
        }
    }
}

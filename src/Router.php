<?php

namespace FilippoFinke;

class Router
{
    private $routes;

    public function __construct()
    {
        $this->routes = array();
    }

    public function get($uri, $function)
    {
        if (!isset($this->routes["GET"])) {
            $this->routes["GET"] = array();
        }
        $this->routes["GET"][] = new Route($uri, $function);
    }

    public function post($route, $function)
    {
    }

    public function start()
    {
        $request = new Request(
            $_SERVER["REQUEST_URI"],
            $_SERVER["REQUEST_METHOD"],
            $_SERVER["REMOTE_ADDR"]
        );
        $uri = $request->getUri();
        $method = $request->getMethod();
        $routeFound = false;
        if (isset($this->routes[$method])) {
            $routes = $this->routes[$method];
            foreach ($routes as $route) {
                if ($route->getUri() === $uri) {
                    $route->call($request, new Response());
                    $routeFound = true;
                    break;
                }
            }
        }
        if (!$routeFound) {
            echo $method.' '.$uri.' not found';
        }
    }
}

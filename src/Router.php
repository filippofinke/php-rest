<?php

namespace FilippoFinke;

class Router
{
    private $routes = array();

    public function getRoutes()
    {
        return $this->routes;
    }
    
    public function __call($method, $args)
    {
        $method = \strtoupper($method);
        if (!isset($this->routes[$method])) {
            $this->routes[$method] = array();
        }
        $route = new Route($args[0], $args[1]);
        $this->routes[$method][] = $route;
        return $route;
    }

    public function map($methods, $uri, $function)
    {
        $routeGroup = new RouteGroup();
        foreach ($methods as $method) {
            $route = $this->{$method}($uri, $function);
            $routeGroup->add($route);
        }
        return $routeGroup;
    }

    public function start()
    {
        $request = new Request();
        $uri = $request->getUri();
        $method = $request->getMethod();
        if (isset($this->routes[$method])) {
            $routes = $this->routes[$method];
            foreach ($routes as $route) {
                preg_match('/^'.$route->getUri().'$/', $uri, $output);
                if ($output) {
                    $response = new Response();
                    $request->withAttribute('args', $output);
                    return $route->call($request, $response);
                }
            }
        }
        
        // Route not found
        $response = new Response();
        return $response->withText("$method $uri not found")->withStatus(404);
    }
}

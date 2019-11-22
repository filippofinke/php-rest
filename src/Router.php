<?php

namespace FilippoFinke;

class Router
{
    private $routes = array();
    
    public function get($uri, $function)
    {
        if (!isset($this->routes["GET"])) {
            $this->routes["GET"] = array();
        }
        $this->routes["GET"][] = new Route($uri, $function);
    }

    public function start()
    {
        $request = new Request();
        $uri = $request->getUri();
        $method = $request->getMethod();
        if (isset($this->routes[$method])) {
            $routes = $this->routes[$method];
            foreach ($routes as $route) {
                if ($route->getUri() === $uri) {
                    return $route->call($request, new Response());
                }
            }
        }

        // Route not found
        $response = new Response();
        return $response->withText("$method $uri not found")->withStatus(404);
    }
}

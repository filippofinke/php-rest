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
        $route = new Route($uri, $function);
        $this->routes["GET"][] = $route;
        return $route;
    }

    public function post($uri, $function)
    {
        if (!isset($this->routes["POST"])) {
            $this->routes["POST"] = array();
        }
        $route = new Route($uri, $function);
        $this->routes["POST"][] = $route;
        return $route;
    }

    public function put($uri, $function)
    {
        if (!isset($this->routes["PUT"])) {
            $this->routes["PUT"] = array();
        }
        $route = new Route($uri, $function);
        $this->routes["PUT"][] = $route;
        return $route;
    }

    public function delete($uri, $function)
    {
        if (!isset($this->routes["DELETE"])) {
            $this->routes["DELETE"] = array();
        }
        $route = new Route($uri, $function);
        $this->routes["DELETE"][] = $route;
        return $route;
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

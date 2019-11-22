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

    public function post($uri, $function)
    {
        if (!isset($this->routes["POST"])) {
            $this->routes["POST"] = array();
        }
        $this->routes["POST"][] = new Route($uri, $function);
    }

    public function put($uri, $function)
    {
        if (!isset($this->routes["PUT"])) {
            $this->routes["PUT"] = array();
        }
        $this->routes["PUT"][] = new Route($uri, $function);
    }

    public function delete($uri, $function)
    {
        if (!isset($this->routes["DELETE"])) {
            $this->routes["DELETE"] = array();
        }
        $this->routes["DELETE"][] = new Route($uri, $function);
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

<?php
/**
 * @author Filippo Finke
 */
namespace FilippoFinke;

class Router
{
    private $routes = array();

    private $before = array();
    
    private $after = array();

    public function getRoutes()
    {
        return $this->routes;
    }

    public function before($function)
    {
        $this->before[] = $function;
        return $this;
    }

    public function after($function)
    {
        $this->after[] = $function;
        return $this;
    }
    
    public function __call($method, $args)
    {
        $method = \strtoupper($method);
        if (!isset($this->routes[$method])) {
            $this->routes[$method] = array();
        }
        $route = new Route($method, $args[0], $args[1]);
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
                $matches = $route->match($uri);
                if ($matches) {
                    $response = new Response();
                    if(is_array($matches)) {
                        foreach ($matches as $match => $value) {
                            $request->withAttribute($match, $value);
                        }
                    }
                    foreach ($this->before as $before) {
                        \call_user_func($before, $request, $response);
                    }
                    
                    $route->call($request, $response);
                    
                    foreach ($this->after as $after) {
                        \call_user_func($after, $request, $response);
                    }
                    return;
                }
            }
        }

        $response = new Response();
        return $response->withText("$method $uri not found")->withStatus(404);
    }
}

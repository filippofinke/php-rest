<?php
/**
 * @author Filippo Finke
 */
namespace FilippoFinke;

class RouteGroup
{
    private $routes = array();

    public function getRoutes()
    {
        return $this->routes;
    }

    public function add(&$route)
    {
        $this->routes[] = $route;
        return $this;
    }

    public function before($function)
    {
        foreach ($this->routes as $route) {
            $route->before($function);
        }
        return $this;
    }

    public function after($function)
    {
        foreach ($this->routes as $route) {
            $route->after($function);
        }
        return $this;
    }
}

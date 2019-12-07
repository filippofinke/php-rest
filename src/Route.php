<?php
namespace FilippoFinke;

class Route
{
    private $uri;

    private $method;

    private $function;

    private $before;

    private $after;

    public function getUri()
    {
        return $this->uri;
    }

    public function getFunction()
    {
        return $this->function;
    }

    public function getMethod() {
        return $this->method;
    }

    public function before($function)
    {
        $this->before = $function;
        return $this;
    }

    public function after($function)
    {
        $this->after = $function;
        return $this;
    }
 
    public function call(&$request, &$response)
    {
        if ($this->before) {
            \call_user_func($this->before, $request, $response);
        }

        \call_user_func($this->function, $request, $response);

        if ($this->after) {
            \call_user_func($this->after, $request, $response);
        }
    }

    public function __construct($method, $uri, $function)
    {
        $this->method = $method;
        $this->uri = str_replace("/", "\/", $uri);
        $this->function = $function;
    }
}

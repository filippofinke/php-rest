<?php
namespace FilippoFinke;

class Route
{
    private $uri;

    private $method;

    private $function;

    private $before;

    private $after;

    private $parser;

    public function match($uri) {
        return $this->parser->parse($uri);
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getFunction()
    {
        return $this->function;
    }

    public function getMethod()
    {
        return $this->method;
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
 
    public function call(&$request, &$response)
    {
        foreach ($this->before as $before) {
            \call_user_func($before, $request, $response);
        }

        \call_user_func($this->function, $request, $response);

        foreach ($this->after as $after) {
            \call_user_func($after, $request, $response);
        }
    }

    public function __construct($method, $uri, $function)
    {
        $this->method = $method;
        $this->parser = new RouteParser($uri);
        $this->function = $function;
        $this->before = array();
        $this->after = array();
    }
}

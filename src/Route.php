<?php 
namespace FilippoFinke;

class Route {
    
    private $uri;

    private $function;

    public function getUri() {
        return $this->uri;
    }

    public function getFunction() {
        return $this->function;
    }

    public function call($request, $response) {
        \call_user_func($this->function, $request, $response);
    }

    public function __construct($uri, $function) {
        $this->uri = $uri;
        $this->function = $function;
    }

}
<?php

namespace FilippoFinke;

class Request
{
    private $uri;

    private $method;
    
    private $remoteAddress;

    public function getUri()
    {
        return $this->uri;
    }

    public function getMethod() {
        return $this->method;
    }

    public function getRemoteAddress() {
        return $this->remoteAddress;
    }

    public function __construct(
        $uri,
        $method,
        $remoteAddress
    ) {
        $this->uri = $uri;
        $this->method = $method;
        $this->remoteAddress = $remoteAddress;
    }
}

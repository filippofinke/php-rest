<?php

namespace FilippoFinke;

class Request
{
    private $uri;

    private $method;

    private $headers;
    
    private $remoteAddress;

    private $time;

    private $timeFloat;

    public function getUri()
    {
        return $this->uri;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getRemoteAddress()
    {
        return $this->remoteAddress;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getTimeFloat()
    {
        return $this->timeFloat;
    }

    public function getHeader($header)
    {
        if (isset($this->headers[$header])) {
            return $this->headers[$header];
        }
        return null;
    }


    public function __construct(
        $uri,
        $method,
        $headers,
        $remoteAddress,
        $time,
        $timeFloat
    ) {
        $this->uri = $uri;
        $this->method = $method;
        $this->headers = $headers;
        $this->remoteAddress = $remoteAddress;
        $this->time = $time;
        $this->timeFloat = $timeFloat;
    }
}

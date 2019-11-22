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

    private $params;

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

    public function getParams()
    {
        return $this->params;
    }

    public function getParam($param)
    {
        if (isset($this->params[$param])) {
            return $this->params[$param];
        }
        return null;
    }


    public function __construct()
    {
        $this->uri = $_SERVER["PHP_SELF"];
        $this->method = $_SERVER["REQUEST_METHOD"];
        $this->headers = getallheaders();
        $this->remoteAddress = $_SERVER["REMOTE_ADDR"];
        $this->time = $_SERVER["REQUEST_TIME"];
        $this->timeFloat = $_SERVER["REQUEST_TIME_FLOAT"];
        if ($this->getMethod() === "GET") {
            $this->params = $_GET;
        } elseif ($this->getMethod() === "POST") {
            $this->params = $_POST;
        } else {
            $this->params = array();
        }
    }
}

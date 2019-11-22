<?php

namespace FilippoFinke;

class Response
{
    private $headers = array();

    private $content = '';

    private $status = 200;

    public function withHeader($header, $value)
    {
        $this->headers[$header] = $value;
        return $this;
    }

    public function withStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function withHtml($html)
    {
        $this->withHeader('Content-Type', 'text/html');
        $this->content = $html;
        return $this;
    }

    public function withText($text)
    {
        $this->withHeader('Content-Type', 'text/plain');$this->content = $text;
        return $this;
    }

    public function withJson($array)
    {
        $this->withHeader('Content-Type', 'application/json');
        $this->content = \json_encode($array);
        return $this;
    }

    public function __destruct()
    {
        http_response_code($this->status);
        foreach ($this->headers as $header => $value) {
            header($header.': '.$value);
        }
        echo $this->content;
    }
}

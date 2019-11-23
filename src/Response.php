<?php

namespace FilippoFinke;

class Response
{
    private $headers = array();

    private $content = '';

    private $status = 200;

    private $redirect;

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getStatus()
    {
        return $this->status;
    }

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
        $this->withHeader('Content-Type', 'text/plain');
        $this->content = $text;
        return $this;
    }

    public function withXml($xml)
    {
        $this->withHeader('Content-Type', 'text/xml');
        $this->content = $xml;
        return $this;
    }

    public function withCsv($csv)
    {
        $this->withHeader('Content-Type', 'text/csv');
        $this->content = $csv;
        return $this;
    }

    public function withJson($array)
    {
        $this->withHeader('Content-Type', 'application/json');
        $this->content = \json_encode($array);
        return $this;
    }

    public function redirect($uri)
    {
        $this->redirect = $uri;
        return $this;
    }

    public function append($content)
    {
        $this->content .= $content;
        return $this;
    }

    public function __destruct()
    {
        http_response_code($this->status);
        foreach ($this->headers as $header => $value) {
            header($header.': '.$value);
        }
        if ($this->redirect) {
            header("Location: ".$this->redirect);
        } else {
            echo $this->content;
        }
    }
}

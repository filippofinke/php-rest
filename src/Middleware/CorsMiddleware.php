<?php

namespace FilippoFinke\Middleware;

/**
 * https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
 */
class CorsMiddleware
{
    private $origin;
    private $methods;
    private $headers;
    private $exposeHeaders;
    private $maxAge;
    private $credentials;

    public function __construct($origin, $methods = null, $headers = null, $exposeHeaders = null, $maxAge = null, $credentials = null)
    {
        $this->origin = $origin;
        $this->methods = $methods;
        $this->headers = $headers;
        $this->exposeHeaders = $exposeHeaders;
        $this->maxAge = $maxAge;
        $this->credentials = $credentials;
    }

    public function __invoke($request, $response)
    {
        $response->withHeader('Access-Control-Allow-Origin', $this->origin);
        if ($this->methods) {
            $response->withHeader('Access-Control-Allow-Methods', \strtoupper(implode(", ", $this->methods)));
        }
        if ($this->headers) {
            $response->withHeader('Access-Control-Allow-Headers', \strtoupper(implode(", ", $this->headers)));
        }
        if ($this->exposeHeaders) {
            $response->withHeader('Access-Control-Expose-Headers', \strtoupper(implode(", ", $this->exposeHeaders)));
        }
        if ($this->maxAge) {
            $response->withHeader('Access-Control-Max-Age', $this->maxAge);
        }
        if ($this->credentials) {
            $response->withHeader('Access-Control-Allow-Credentials', $this->credentials);
        }
    }
}

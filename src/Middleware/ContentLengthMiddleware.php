<?php
/**
 * @author Filippo Finke
 */
namespace FilippoFinke\Middleware;

class ContentLengthMiddleware
{
    public function __invoke($request, $response)
    {
        $response->withHeader('Content-Length', strlen($response->getContent()));
    }
}

<?php

namespace PhpMiddleware;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DoublePassDelegate implements DelegateInterface
{
    private $delegate;
    private $response;

    public function __construct(callable $delegate, ResponseInterface $response)
    {
        $this->delegate = $delegate;
        $this->response = $response;
    }

    public function process(ServerRequestInterface $request)
    {
        return call_user_func($this->delegate, $request, $this->response);
    }
}

<?php

namespace PhpMiddleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

trait DoublePassCompatibilityTrait
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param callable $next
     *
     * @return ResponseInterface
     */
    final public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $delegate = new DoublePassDelegate($next, $response);

        return $this->process($request, $delegate);
    }
}

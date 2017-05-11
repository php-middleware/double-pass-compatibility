<?php

namespace PhpMiddleware\Test;

use Interop\Http\ServerMiddleware\DelegateInterface;
use PhpMiddleware\AbstractDoublePassCompatibilityMiddleware;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AbstractDoublePassCompatibilityMiddlewareTest extends TestCase
{
    public function testExecuteSinglePassOnDoublePassCall()
    {
        $request = $this->getMockBuilder(ServerRequestInterface::class)->getMock();
        $response = $this->getMockBuilder(ResponseInterface::class)->getMock();

        $next = function ($request, $response) {
            return $response;
        };

        $middleware = $this->getMockForAbstractClass(AbstractDoublePassCompatibilityMiddleware::class);
        $middleware->method('process')->willReturnCallback(function(ServerRequestInterface $request, DelegateInterface $delegate) {
            return $delegate->process($request);
        });

        $result = $middleware($request, $response, $next);

        $this->assertSame($response, $result);
    }

    public function testExecuteSinglePassOnDoublePassCallAndReturnNewResponse()
    {
        $request = $this->getMockBuilder(ServerRequestInterface::class)->getMock();
        $response = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $newResponse = $this->getMockBuilder(ResponseInterface::class)->getMock();

        $next = function ($request, $response) {
            return $response;
        };

        $middleware = $this->getMockForAbstractClass(AbstractDoublePassCompatibilityMiddleware::class);
        $middleware->method('process')->willReturnCallback(function(ServerRequestInterface $request, DelegateInterface $delegate) use ($newResponse) {
            return $newResponse;
        });

        $result = $middleware($request, $response, $next);

        $this->assertSame($newResponse, $result);
    }
}

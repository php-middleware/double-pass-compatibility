<?php

namespace PhpMiddleware;

use Interop\Http\ServerMiddleware\MiddlewareInterface;

abstract class AbstractDoublePassCompatibilityMiddleware implements MiddlewareInterface
{
    use DoublePassCompatibilityTrait;
}

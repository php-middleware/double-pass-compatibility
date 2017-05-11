# double-pass-compatibility [![Build Status](https://travis-ci.org/php-middleware/double-pass-compatibility.svg?branch=master)](https://travis-ci.org/php-middleware/double-pass-compatibility)

This package provide trait and abstract class for your [psr-15 middlewares](https://github.com/http-interop/http-middleware#42-single-pass-lambda) to [double pass middewares](https://github.com/http-interop/http-middleware#41-double-pass) support. So you can call your middleware in both styles.

**Standard PSR-15 call:**

```php
$middleware->process($request, $delegate);
```

**Possible call after implements this package:**

```php
$middleware($request, $response, $next);
```

## Installation

```bash
composer require php-middleware/double-pass-compatibility
```

You can add trait into your middeware:

```php
class Middleware implements MiddlewareInterface
{
    use PhpMiddleware\DoublePassCompatibilityTrait;

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
       // Implementation and return response
    }
}
```

Or extend abstract class:

```php
class Middleware extend AbstractDoublePassCompatibilityMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
       // Implementation and return response
    }
}
```

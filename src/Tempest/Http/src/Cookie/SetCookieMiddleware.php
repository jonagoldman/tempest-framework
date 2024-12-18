<?php

declare(strict_types=1);

namespace Tempest\Http\Cookie;

use Tempest\Http\HttpMiddleware;
use Tempest\Http\HttpMiddlewareCallable;
use Tempest\Http\Request;
use Tempest\Http\Response;

final readonly class SetCookieMiddleware implements HttpMiddleware
{
    public function __construct(private CookieManager $cookies)
    {
    }

    public function __invoke(Request $request, HttpMiddlewareCallable $next): Response
    {
        $response = $next($request);

        foreach ($this->cookies->all() as $cookie) {
            $response->addHeader('set-cookie', (string) $cookie);
        }

        return $response;
    }
}

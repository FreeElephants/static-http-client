<?php

namespace FreeElephants\StaticHttpClient\PathResolver;

use Psr\Http\Message\RequestInterface;

interface PathResolverInterface
{
    public function resolve(RequestInterface $request): string;
}

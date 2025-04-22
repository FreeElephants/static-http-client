<?php

namespace FreeElephants\StaticHttpClient\PathBuilder;

use Psr\Http\Message\RequestInterface;

interface PathBuilderInterface
{
    public function build(RequestInterface $request, string $path = ''): string;
}

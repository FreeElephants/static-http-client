<?php

namespace FreeElephants\StaticHttpClient\PathBuilder;

use Psr\Http\Message\RequestInterface;

class AppendRequestPath implements PathBuilderInterface
{
    public function build(RequestInterface $request, string $path = ''): string
    {
        return $path . $request->getUri()->getPath();
    }
}

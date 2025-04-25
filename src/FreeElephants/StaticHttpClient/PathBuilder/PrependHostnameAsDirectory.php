<?php

namespace FreeElephants\StaticHttpClient\PathBuilder;

use Psr\Http\Message\RequestInterface;

class PrependHostnameAsDirectory implements PathBuilderInterface
{
    public function build(RequestInterface $request, string $path = ''): string
    {
        return $request->getUri()->getHost() . $path;
    }

}

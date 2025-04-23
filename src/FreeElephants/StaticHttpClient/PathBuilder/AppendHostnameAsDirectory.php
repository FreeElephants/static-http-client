<?php

namespace FreeElephants\StaticHttpClient\PathBuilder;

use Psr\Http\Message\RequestInterface;

class AppendHostnameAsDirectory implements PathBuilderInterface
{
    public function build(RequestInterface $request, string $path = ''): string
    {
        return $path . DIRECTORY_SEPARATOR . $request->getUri()->getHost();
    }

}

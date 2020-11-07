<?php

namespace FreeElephants\StaticHttpClient\PathResolver;

use Psr\Http\Message\RequestInterface;

class HostnameAwareResolver implements PathResolverInterface
{

    private string $basePath;

    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;
    }

    public function resolve(RequestInterface $request): string
    {
        $host = $request->getUri()->getHost();
        $path = $request->getUri()->getPath();

        return $this->basePath . DIRECTORY_SEPARATOR . $host . $path;
    }
}

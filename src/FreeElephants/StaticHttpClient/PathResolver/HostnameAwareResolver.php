<?php

namespace FreeElephants\StaticHttpClient\PathResolver;

use FreeElephants\StaticHttpClient\PathResolver\Exception\UnresolvablePathException;
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
        $filename = $this->basePath . DIRECTORY_SEPARATOR . $host . $path;
        if(file_exists($filename)) {
            return $filename;
        }

        throw new UnresolvablePathException();
    }
}

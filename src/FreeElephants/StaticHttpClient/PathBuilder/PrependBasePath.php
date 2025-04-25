<?php

namespace FreeElephants\StaticHttpClient\PathBuilder;

use Psr\Http\Message\RequestInterface;

class PrependBasePath implements PathBuilderInterface
{
    private string $basePath;

    public function __construct(string $basePath)
    {
        $this->basePath = rtrim($basePath, DIRECTORY_SEPARATOR);
    }

    public function build(RequestInterface $request, string $path = ''): string
    {
        return $this->basePath . DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR);
    }
}

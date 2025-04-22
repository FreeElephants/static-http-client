<?php

namespace FreeElephants\StaticHttpClient\PathResolver;

use FreeElephants\StaticHttpClient\PathResolver\Exception\UnresolvablePathException;
use Psr\Http\Message\RequestInterface;

/**
 * Find file with configured extension added to request path.
 */
class FileExtensionAwareResolver implements PathResolverInterface
{
    private string $basePath;
    private string $fileExtension;

    public function __construct(
        string $basePath,
        string $fileExtension = '.json'
    )
    {
        $this->basePath = $basePath;
        $this->fileExtension = $fileExtension;
    }

    public function resolve(RequestInterface $request): string
    {
        $path = $request->getUri()->getPath() . $this->fileExtension;

        if (file_exists($this->basePath . $path)) {
            return $this->basePath . $path;
        }

        throw new UnresolvablePathException();
    }
}

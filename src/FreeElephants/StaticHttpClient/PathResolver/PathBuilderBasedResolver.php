<?php

namespace FreeElephants\StaticHttpClient\PathResolver;

use FreeElephants\StaticHttpClient\PathBuilder\PathBuilderInterface;
use FreeElephants\StaticHttpClient\PathResolver\Exception\UnresolvablePathException;
use Psr\Http\Message\RequestInterface;

class PathBuilderBasedResolver implements PathResolverInterface
{
    private PathBuilderInterface $pathBuilder;

    public function __construct(PathBuilderInterface $pathBuilder)
    {
        $this->pathBuilder = $pathBuilder;
    }

    public function resolve(RequestInterface $request): string
    {
        $filename = $this->pathBuilder->build($request);

        if (file_exists($filename)) {
            return $filename;
        }

        throw new UnresolvablePathException();
    }
}

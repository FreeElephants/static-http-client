<?php

namespace FreeElephants\StaticHttpClient\PathBuilder;

use Psr\Http\Message\RequestInterface;

class AppendDefaultFileExtension implements PathBuilderInterface
{

    private string $fileExtension;

    public function __construct(string $fileExtension = '.json')
    {
        $this->fileExtension = $fileExtension;
    }

    public function build(RequestInterface $request, string $path = ''): string
    {
        return $path . $this->fileExtension;
    }
}

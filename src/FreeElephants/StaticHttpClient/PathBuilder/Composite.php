<?php

namespace FreeElephants\StaticHttpClient\PathBuilder;

use Psr\Http\Message\RequestInterface;

class Composite implements PathBuilderInterface
{
    private array $builders;

    public function __construct(PathBuilderInterface ...$builders)
    {
        $this->builders = $builders;
    }

    public function build(RequestInterface $request, string $path = ''): string
    {
        foreach ($this->builders as $builder) {
            $path = $builder->build($request, $path);
        }

        return $path;
    }
}

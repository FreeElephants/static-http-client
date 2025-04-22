<?php

namespace FreeElephants\StaticHttpClient\PathResolver;

use FreeElephants\StaticHttpClient\AbstractTestCase;
use FreeElephants\StaticHttpClient\PathBuilder\AppendRequestPath;
use FreeElephants\StaticHttpClient\PathBuilder\BasePath;
use FreeElephants\StaticHttpClient\PathBuilder\Composite;
use FreeElephants\StaticHttpClient\PathBuilder\DefaultFileExtension;
use FreeElephants\StaticHttpClient\PathBuilder\PathBuilderInterface;
use FreeElephants\StaticHttpClient\PathResolver\Exception\UnresolvablePathException;
use Nyholm\Psr7\Request;
use PHPUnit\Framework\TestCase;

class PathBuilderBasedResolverTest extends AbstractTestCase
{
    public function testResolve(): void
    {
        $pathBuilderBasedResolver = new PathBuilderBasedResolver(
            new Composite(
                new BasePath(self::FIXTURE_PATH),
                new AppendRequestPath(),
                new DefaultFileExtension()
            )
        );

        $actual = $pathBuilderBasedResolver->resolve(new Request('GET', 'http://example.com/foo'));
        $this->assertSame(self::FIXTURE_PATH . DIRECTORY_SEPARATOR . 'foo.json', $actual);
    }

    public function testUnresolvedException(): void
    {
        $pathBuilderBasedResolver = new PathBuilderBasedResolver($this->createMock(PathBuilderInterface::class));;

        $this->expectException(UnresolvablePathException::class);
        $pathBuilderBasedResolver->resolve(new Request('GET', 'http://example.com/foo'));
    }
}

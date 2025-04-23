<?php

namespace FreeElephants\StaticHttpClient\PathResolver;

use FreeElephants\StaticHttpClient\AbstractTestCase;
use FreeElephants\StaticHttpClient\PathBuilder\AppendRequestPath;
use FreeElephants\StaticHttpClient\PathBuilder\PrependBasePath;
use FreeElephants\StaticHttpClient\PathBuilder\Composite;
use FreeElephants\StaticHttpClient\PathBuilder\AppendDefaultFileExtension;
use FreeElephants\StaticHttpClient\PathBuilder\PathBuilderInterface;
use FreeElephants\StaticHttpClient\PathBuilder\PrependHostnameAsDirectory;
use FreeElephants\StaticHttpClient\PathResolver\Exception\UnresolvablePathException;
use Nyholm\Psr7\Request;
use PHPUnit\Framework\TestCase;

class PathBuilderBasedResolverTest extends AbstractTestCase
{
    public function testResolve(): void
    {
        $pathBuilderBasedResolver = new PathBuilderBasedResolver(
            new Composite(
                new PrependBasePath(self::FIXTURE_PATH),
                new PrependHostnameAsDirectory(),
                new AppendRequestPath(),
                new AppendDefaultFileExtension('.html')
            )
        );

        $actual = $pathBuilderBasedResolver->resolve(new Request('GET', 'http://example.com/bar'));
        $this->assertSame(self::FIXTURE_PATH . '/example.com/bar.html', $actual);
    }

    public function testUnresolvedException(): void
    {
        $pathBuilderBasedResolver = new PathBuilderBasedResolver($this->createMock(PathBuilderInterface::class));;

        $this->expectException(UnresolvablePathException::class);
        $pathBuilderBasedResolver->resolve(new Request('GET', 'http://example.com/bar'));
    }
}

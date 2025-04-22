<?php

namespace FreeElephants\StaticHttpClient\PathResolver;

use FreeElephants\StaticHttpClient\AbstractTestCase;
use FreeElephants\StaticHttpClient\PathResolver\Exception\UnresolvablePathException;
use Nyholm\Psr7\Request;

class FileExtensionAwareResolverTest extends AbstractTestCase
{
    public function testResolve(): void
    {
        $resolver = new FileExtensionAwareResolver(self::FIXTURE_PATH);

        $this->assertSame(self::FIXTURE_PATH . DIRECTORY_SEPARATOR . 'foo.json', $resolver->resolve(new Request('GET', '/foo')));
    }

    public function testUnresolvedException(): void
    {
        $resolver = new FileExtensionAwareResolver(self::FIXTURE_PATH);

        $this->expectException(UnresolvablePathException::class);

        $resolver->resolve(new Request('GET', '/path-that-does-not-exists'));
    }
}

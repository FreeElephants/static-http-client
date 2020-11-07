<?php

namespace FreeElephants\StaticHttpClient\PathResolver;

use FreeElephants\StaticHttpClient\AbstractTestCase;
use Nyholm\Psr7\Request;
use PHPUnit\Framework\TestCase;

class HostnameAwareResolverTest extends AbstractTestCase
{

    public function testResolve()
    {
        $resolver = new HostnameAwareResolver(self::FIXTURE_PATH);

        $path = $resolver->resolve(new Request('GET', 'http://example.com/index.html'));

        $this->assertSame(self::FIXTURE_PATH . DIRECTORY_SEPARATOR . 'example.com' . DIRECTORY_SEPARATOR . 'index.html', $path);
    }
}

<?php

namespace FreeElephants\StaticHttpClient\PathBuilder;

use FreeElephants\StaticHttpClient\AbstractTestCase;
use Nyholm\Psr7\Request;

class CompositeTest extends AbstractTestCase
{

    public function testBuild(): void
    {
        $composite = new Composite(
            new AppendRequestPath(),
            new PrependHostnameAsDirectory(),
            new PrependBasePath('/root'),
            new AppendDefaultFileExtension(),
        );

        $path = $composite->build(new Request('GET', 'http://example.com/foo'));

        $this->assertSame('/root/example.com/foo.json', $path, 'Composite should build path from all builders');
    }
}

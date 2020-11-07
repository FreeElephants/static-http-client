<?php

namespace FreeElephants\StaticHttpClient;

use FreeElephants\StaticHttpClient\PathResolver\HostnameAwareResolver;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Request;

class StaticHttpClientTest extends AbstractTestCase
{
    public function testGetOk()
    {
        $client = new StaticHttpClient(new Psr17Factory(), new HostnameAwareResolver(self::FIXTURE_PATH));

        $request = new Request('GET', 'http://example.com/index.html');
        $response = $client->sendRequest($request);

        $this->assertResponseHasStatus($response, 200);
        $this->assertStringContainsString('<title>Example Domain</title>', $response->getBody()->getContents());
    }

    public function testGetNotFound()
    {
        $client = new StaticHttpClient(new Psr17Factory(), new HostnameAwareResolver(self::FIXTURE_PATH));

        $request = new Request('GET', 'http://example.com/not-found');
        $response = $client->sendRequest($request);

        $this->assertResponseHasStatus($response, 404);
    }
}

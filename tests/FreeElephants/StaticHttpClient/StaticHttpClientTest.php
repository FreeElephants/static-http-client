<?php

namespace FreeElephants\StaticHttpClient;

use Helmich\Psr7Assert\Psr7Assertions;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Request;
use PHPUnit\Framework\TestCase;

class StaticHttpClientTest extends TestCase
{
    use Psr7Assertions;

    protected const FIXTURE_PATH = __DIR__ . '/../../_fixtures';

    public function testSuccessGet()
    {
        $client = new StaticHttpClient(new Psr17Factory(), self::FIXTURE_PATH);
        $request = new Request('GET', 'http://example.com/index.html');
        $response = $client->sendRequest($request);
        $this->assertResponseHasStatus($response, 200);
        $this->assertStringContainsString('<title>Example Domain</title>', $response->getBody()->getContents());
    }
}

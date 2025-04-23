# Static Http Client

[PSR-18](http://www.php-fig.org/psr/psr-18) implementation for testing. Use static files for mock responses and write requests. 

## Installation 

```shell
composer require free-elephants/static-http-client --dev
```

## Usage

See tests for more examples.

```php
public function test()
{
    $stubbedHttpClient = new \FreeElephants\StaticHttpClient\StaticHttpClient(
        $responseFactory, 
        new \FreeElephants\StaticHttpClient\PathResolver\PathBuilderBasedResolver(
            new \FreeElephants\StaticHttpClient\PathBuilder\Composite(
                new \FreeElephants\StaticHttpClient\PathBuilder\PrependBasePath(__DIR__),
                new \FreeElephants\StaticHttpClient\PathBuilder\PrependHostnameAsDirectory(),
                new \FreeElephants\StaticHttpClient\PathBuilder\AppendRequestPath(),
                new \FreeElephants\StaticHttpClient\PathBuilder\AppendDefaultFileExtension('.json'),
            ) 
        )
    );
    
    $response = $stubbedHttpClient->sendRequest(new \Nyholm\Psr7\Request('GET', 'https://example.com/foo')); // resolved as __DIR__ . '/example.com/foo.json'  
}
```

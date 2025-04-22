# Static Http Client

[PSR-18](http://www.php-fig.org/psr/psr-18) implementation for testing. Use static files for mock responses and write requests. 

## Installation 

```shell
composer require free-elephants/static-http-client --dev
```

## Usage

```php
public function test()
{
    $stubbedHttpClient = new \FreeElephants\StaticHttpClient\StaticHttpClient(
        $responseFactory, 
        new \FreeElephants\StaticHttpClient\PathResolver\HostnameAwareResolver()
    );
    
    $response = $stubbedHttpClient->sendRequest();
}
```

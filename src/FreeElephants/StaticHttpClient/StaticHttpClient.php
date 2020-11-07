<?php

namespace FreeElephants\StaticHttpClient;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

class StaticHttpClient implements ClientInterface
{

    private ResponseFactoryInterface $responseFactory;
    private string $fixturePath;

    public function __construct(ResponseFactoryInterface $responseFactory, string $fixturePath)
    {
        $this->responseFactory = $responseFactory;
        $this->fixturePath = $fixturePath;
    }

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $host = $request->getUri()->getHost();
        $path = $request->getUri()->getPath();
        $responsePath = $this->fixturePath . DIRECTORY_SEPARATOR . $host . $path;
        $responseBodyContent = file_get_contents($responsePath);
        $response = $this->responseFactory->createResponse(200);
        $response->getBody()->write($responseBodyContent);
        $response->getBody()->rewind();
        return $response;
    }
}

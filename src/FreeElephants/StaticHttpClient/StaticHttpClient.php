<?php

namespace FreeElephants\StaticHttpClient;

use FreeElephants\StaticHttpClient\PathResolver\PathResolverInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

class StaticHttpClient implements ClientInterface
{

    private ResponseFactoryInterface $responseFactory;
    private PathResolverInterface $resolver;

    public function __construct(ResponseFactoryInterface $responseFactory, PathResolverInterface $resolver)
    {
        $this->responseFactory = $responseFactory;
        $this->resolver = $resolver;
    }

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $responsePath = $this->resolver->resolve($request);
        $responseBodyContent = file_get_contents($responsePath);
        $response = $this->responseFactory->createResponse(200);
        $response->getBody()->write($responseBodyContent);
        $response->getBody()->rewind();
        return $response;
    }
}

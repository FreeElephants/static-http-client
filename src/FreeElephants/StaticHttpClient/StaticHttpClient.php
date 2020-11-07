<?php

namespace FreeElephants\StaticHttpClient;

use FreeElephants\StaticHttpClient\PathResolver\Exception\UnresolvablePathException;
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
        $status = 200;
        $responseBodyContent = '';

        try {
            $responsePath = $this->resolver->resolve($request);
            $responseBodyContent = file_get_contents($responsePath);
        } catch (UnresolvablePathException $exception) {
            $status = 404;
        }

        $response = $this->responseFactory->createResponse($status);
        $response->getBody()->write($responseBodyContent);
        $response->getBody()->rewind();

        return $response;
    }
}

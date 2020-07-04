<?php

declare(strict_types=1);

namespace Webclient\Extension\ProtocolVersion;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class Client implements ClientInterface
{

    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->client->sendRequest($request);
        if ($response->getStatusCode() === 505) {
            return $this->client->sendRequest($request->withProtocolVersion($response->getProtocolVersion()));
        }
        return $response;
    }
}

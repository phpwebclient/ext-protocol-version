<?php

declare(strict_types=1);

namespace Stuff\Webclient\Extension\ProtocolVersion;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Handler implements RequestHandlerInterface
{

    /**
     * @var string[]
     */
    private $versions;

    public function __construct(string $defaultVersion, string ...$supportedVersions)
    {
        $this->versions[$defaultVersion] = true;
        foreach ($supportedVersions as $version) {
            $this->versions[$version] = true;
        }
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $headers = [
            'Content-Type' => 'text/plain',
        ];
        if (!array_key_exists($request->getProtocolVersion(), $this->versions)) {
            $version = (string)array_keys($this->versions)[0];
            return new Response(505, $headers, 'error', $version, 'HTTP Version Not Supported');
        }
        return new Response(200, $headers, 'success', $request->getProtocolVersion(), 'OK');
    }
}

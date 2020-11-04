<?php

declare(strict_types=1);

namespace Tests\Webclient\Extension\ProtocolVersion;

use Stuff\Webclient\Extension\ProtocolVersion\Handler;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientExceptionInterface;
use Webclient\Extension\ProtocolVersion\Client;
use Webclient\Fake\Client as FakeClient;

class ClientTest extends TestCase
{

    /**
     * @param string $requestVersion
     * @param string $responseVersion
     * @param string[] $supportedVersions
     *
     * @throws ClientExceptionInterface
     *
     * @dataProvider provideProtocol
     */
    public function testProtocol(string $requestVersion, string $responseVersion, array $supportedVersions)
    {
        $client = new Client(new FakeClient(new Handler(...$supportedVersions)));
            $request = new Request('GET', '/', ['Accept' => 'text/plain'], null, $requestVersion);
            $response = $client->sendRequest($request);
            $this->assertSame($responseVersion, $response->getProtocolVersion());
    }

    public function provideProtocol(): array
    {
        return [
            ['1.0', '1.0', ['1.0']],
            ['3', '1.1', ['1.1']],
            ['2', '2', ['1.0', '1.1', '2', '2.0']],
            ['2.1', '2', ['2', '2.0']],
        ];
    }
}

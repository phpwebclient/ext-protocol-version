[![Latest Stable Version](https://img.shields.io/packagist/v/webclient/ext-protocol-version.svg?style=flat-square)](https://packagist.org/packages/webclient/ext-protocol-version)
[![Total Downloads](https://img.shields.io/packagist/dt/webclient/ext-protocol-version.svg?style=flat-square)](https://packagist.org/packages/webclient/ext-protocol-version/stats)
[![License](https://img.shields.io/packagist/l/webclient/ext-protocol-version.svg?style=flat-square)](https://github.com/phpwebclient/ext-protocol-version/blob/master/LICENSE)
[![PHP](https://img.shields.io/packagist/php-v/webclient/ext-protocol-version.svg?style=flat-square)](https://php.net)

# webclient/ext-protocol-version

Auto change protocol version extension for PSR-18 HTTP client.

# Install

Install this package and your favorite [psr-18 implementation](https://packagist.org/providers/psr/http-client-implementation).

```bash
composer require webclient/ext-protocol-version:^1.0
```

# Using

```php
<?php

use Webclient\Extension\ProtocolVersion\Client;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;

/** 
 * @var ClientInterface $client Your PSR-18 HTTP Client
 */
$http = new Client($client);

/** @var RequestInterface $request */
$response = $http->sendRequest($request);
```

If server returns a 505 error, this client will repeat the request with the protocol version specified in the server response.

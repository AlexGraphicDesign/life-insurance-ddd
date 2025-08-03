<?php

declare(strict_types=1);

namespace Infrastructure\Provider\Supplier1\Client;

use Infrastructure\Http\HttpClient;
use Symfony\Contracts\HttpClient\ResponseInterface;

final readonly class Supplier1HttpClient
{
    public function __construct(
        private HttpClient $httpClient,
    ) {
    }

    public function handle(): ResponseInterface
    {
        return $this->httpClient->get();
    }
}

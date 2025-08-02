<?php

declare(strict_types=1);

namespace Infrastructure\Http;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

final readonly class HttpClient
{
    public function __construct(
        private HttpClientInterface $httpClientInterface,
    ) {
    }

    public function get(string $url, array $headers = []): ResponseInterface
    {
        return $this->request('GET', $url, [], $headers);
    }

    public function post(string $url, array $body = [], array $headers = []): ResponseInterface
    {
        return $this->request('POST', $url, ['json', $body], $headers);
    }

    private function request(string $method, string $url, array $options = [], array $headers = []): ResponseInterface
    {
        try {
            return $this->httpClientInterface->request($method, $url, array_merge([
                'headers' => $headers,
            ], $options));
        } catch (TransportExceptionInterface $e) {
            // TODO: Gérer les exceptions proprement
            throw new \Exception('An error occurred while making the request.', 500, $e);
        }
    }
}

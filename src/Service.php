<?php

namespace ItkDev\GetOrganizedApi;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class Service
{
    private ?HttpClientInterface $httpClient = null;

    public function __construct(Client|array $clientOrConfig = [])
    {
        if ($clientOrConfig instanceof Client) {
            $this->client = $clientOrConfig;
        } elseif (is_array($clientOrConfig)) {
            $this->client = new Client($clientOrConfig ?: []);
        } else {
            $errorMessage = sprintf('constructor must be array or instance of %s', Client::class);
            if (class_exists('TypeError')) {
                throw new \TypeError($errorMessage);
            }
            trigger_error($errorMessage, E_USER_ERROR);
        }
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    protected function post(string $path, array $params): array
    {
        $response = $this->getHttpClient()->request('POST', $path, $params);

        return $response->toArray();
    }

    protected function getHttpClient(): HttpClientInterface
    {
        if (null === $this->httpClient) {
            $options = [
                'base_uri' => $this->client->getBaseUrl(),
                'headers' => [
                    'accept' => 'application/json',
                ],
            ];
            if ($this->client->getNtlm()) {
                $options['auth_ntlm'] = $this->client->getUsername().':'.$this->client->getPassword();
            }
            $this->httpClient = HttpClient::create($options);
        }

        return $this->httpClient;
    }
}

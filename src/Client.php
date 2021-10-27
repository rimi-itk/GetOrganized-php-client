<?php

namespace ItkDev\GetOrganizedApi;

use http\Exception\RuntimeException;

class Client
{
    private array $config;

    /**
     * Construct the client.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = array_merge(
            [
                'ntlm' => true,
            ],
            $config
        );
    }

    public function getUsername(): ?string
    {
        return $this->config['username'] ?? null;
    }

    public function setUsername(string $username): self
    {
        $this->config['username'] = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->config['password'] ?? null;
    }

    public function setPassword(string $password): self
    {
        $this->config['password'] = $password;

        return $this;
    }

    public function getNtlm(): bool
    {
        return true === ($this->config['ntlm'] ?? false);
    }

    public function setNtlm(bool $ntlm = true): self
    {
        $this->config['ntlm'] = $ntlm;

        return $this;
    }

    public function setBaseUrl(string $baseUrl): self
    {
        // Make sure that base url ends with a slash.
        $this->config['base_url'] = rtrim($baseUrl, '/').'/';

        return $this;
    }

    public function getBaseUrl(): string
    {
        if (!isset($this->config['base_url'])) {
            throw new \RuntimeException('base_url not defined');
        }

        return $this->config['base_url'];
    }
}

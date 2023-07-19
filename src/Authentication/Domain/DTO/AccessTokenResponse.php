<?php

namespace App\ApplicationName\Authentication\Domain\DTO;

class AccessTokenResponse implements \JsonSerializable
{
    private ?string $accessToken;
    private ?string $expiresAt;

    public function __construct(array $row)
    {
        $this->accessToken = $row['access_token'] ?? null;
        $this->expiresAt = $row['expires_at'] ?? null;
    }

    public function accessToken(): ?string
    {
        return $this->accessToken;
    }

    public function expiresAt(): ?string
    {
        return $this->expiresAt;
    }

    public function toArray(): array
    {
        return [
            'access_token' => $this->accessToken,
            'expires_at' => $this->expiresAt,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}

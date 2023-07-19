<?php

namespace App\ApplicationName\DataStore\AccessToken\Domain\DTO;

class AccessTokenResponse implements \JsonSerializable
{
    private ?int $id;
    private ?int $userId;
    private ?string $accessToken;
    private ?string $expiresAt;

    public function __construct(array $row)
    {
        $this->id = $row['id'] ?? null;
        $this->userId = $row['user_id'] ?? null;
        $this->accessToken = $row['access_token'] ?? null;
        $this->expiresAt = $row['expires_at'] ?? null;
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function userId(): ?int
    {
        return $this->userId;
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
            'id' => $this->id,
            'user_id' => $this->userId,
            'access_token' => $this->accessToken,
            'expires_at' => $this->expiresAt,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}

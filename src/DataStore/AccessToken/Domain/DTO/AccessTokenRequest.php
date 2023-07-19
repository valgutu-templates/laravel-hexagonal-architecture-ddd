<?php

namespace App\ApplicationName\DataStore\AccessToken\Domain\DTO;

class AccessTokenRequest
{
    public function __construct(
        private ?int $id = null,
        private ?int $userId = null,
        private ?string $accessToken = null,
        private ?string $expiresAt = null,
    )
    {
    }

    public function id(): ?string
    {
        return $this->id;
    }

    public function userId(): int
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
}

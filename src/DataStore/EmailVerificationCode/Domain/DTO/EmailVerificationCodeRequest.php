<?php

namespace App\ApplicationName\DataStore\EmailVerificationCode\Domain\DTO;

class EmailVerificationCodeRequest
{
    public function __construct(
        private ?int $id = null,
        private ?int $userId = null,
        private ?string $code = null,
        private ?string $expiresAt = null,
        private ?bool $sent = false,
        private ?bool $confirmed = false,
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

    public function code(): ?string
    {
        return $this->code;
    }

    public function sent(): bool
    {
        return $this->sent;
    }

    public function confirmed(): bool
    {
        return $this->confirmed;
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
            'code' => $this->code,
            'sent' => $this->sent,
            'confirmed' => $this->confirmed,
            'expires_at' => $this->expiresAt,
        ];
    }
}

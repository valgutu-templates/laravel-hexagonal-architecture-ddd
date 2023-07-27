<?php

namespace App\ApplicationName\DataStore\EmailVerificationCode\Domain\DTO;

class EmailVerificationCodeResponse implements \JsonSerializable
{
    private ?int $id;
    private ?int $userId;
    private ?string $code;
    private bool $sent;
    private bool $confirmed;
    private ?string $expiresAt;

    public function __construct(array $row)
    {
        $this->id = $row['id'] ?? null;
        $this->userId = $row['user_id'] ?? null;
        $this->code = $row['code'] ?? null;
        $this->sent = $row['sent'] ?? false;
        $this->confirmed = $row['confirmed'] ?? false;
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

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}

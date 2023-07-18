<?php

namespace App\ApplicationName\Authentication\Domain\DTO;

use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

class JWTResponse
{
    public function __construct(
        private int $status,
        private ?string $token = null,
        private ?int $expiresIn = null,
    )
    {
    }

    private function status(): int
    {
        return $this->status;
    }

    private function token(): ?string
    {
        return $this->token;
    }

    private function expiresIn(): int
    {
        return $this->expiresIn;
    }
}

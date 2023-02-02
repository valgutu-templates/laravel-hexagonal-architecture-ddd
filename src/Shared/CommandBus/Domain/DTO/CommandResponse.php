<?php

namespace App\ApplicationName\Shared\CommandBus\Domain\DTO;

class CommandResponse
{
    public function __construct(
        private bool $success,
        private int $statusCode,
        private string $message = ''
    )
    {
    }

    public function success(): bool
    {
        return $this->success;
    }

    public function statusCode(): int
    {
        return $this->statusCode;
    }

    public function message(): string
    {
        return $this->message;
    }
}

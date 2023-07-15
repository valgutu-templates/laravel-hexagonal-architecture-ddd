<?php

namespace App\ApplicationName\Shared\CommandBus\Domain\DTO;

class CommandResponse
{
    public function __construct(
        private int $status,
        private array $data = []
    )
    {
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getData(): array
    {
        return $this->data;
    }
}

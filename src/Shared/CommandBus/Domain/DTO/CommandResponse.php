<?php

namespace App\ApplicationName\Shared\CommandBus\Domain\DTO;

class CommandResponse
{
    public function __construct(
        private int $status,
        private array $data = [],
        private array $errors = []
    )
    {
        if (!empty($this->errors)) {
            $this->setErrors($errors);
        }
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getData(): array
    {
        return $this->data;
    }

    protected function setErrors(array $errors): void
    {
        $this->data['errors'] = $errors;
    }
}

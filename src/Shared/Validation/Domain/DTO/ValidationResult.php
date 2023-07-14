<?php

namespace App\ApplicationName\Shared\Validation\Domain\DTO;

use JsonSerializable;

class ValidationResult implements JsonSerializable
{
    public function __construct(
        private array $errors = [],
    )
    {
    }

    public function isValid(): bool
    {
        return empty($this->errors);
    }

    public function isFailed(): bool
    {
        return !$this->isValid();
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function addError(string $field, string $error): void
    {
        $this->errors[$field] = $error;
    }

    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }

    public function jsonSerialize()
    {
        $payload = [
            'status'  => $this->errors ? 'error' : 'success',
        ];

        if ($this->errors) {
            $payload['errors'] = $this->errors;
        }

        return $payload;
    }
}

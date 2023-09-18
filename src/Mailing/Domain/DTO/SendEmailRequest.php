<?php

namespace App\ApplicationName\Mailing\Domain\DTO;

class SendEmailRequest
{
    public function __construct(
        private ?string $type = null,
        private ?string $toEmail = null,
        private ?array $data = []
    )
    {

    }

    public function type(): ?string
    {
        return $this->type;
    }

    public function toEmail(): ?string
    {
        return $this->toEmail;
    }

    public function data(): array
    {
        return $this->data;
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'to_email' => $this->toEmail,
            'data' => $this->data,
        ];
    }
}

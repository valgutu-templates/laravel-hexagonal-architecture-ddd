<?php

namespace App\ApplicationName\Authentication\Domain\DTO;

class AuthenticationRequest
{
    public function __construct(
        private ?string $email = null,
        private ?string $password = null
    )
    {
    }

    public function email(): ?string
    {
        return $this->email;
    }

    public function password(): ?string
    {
        return $this->password;
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password
        ];
    }
}

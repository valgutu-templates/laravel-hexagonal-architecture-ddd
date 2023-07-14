<?php

namespace App\ApplicationName\Authentication\Domain\DTO;

class AuthenticationRequest
{
    public function __construct(
        private ?string $email = null,
        private ?string $phone = null,
        private ?string $password = null
    )
    {
    }

    public function email(): ?string
    {
        return $this->email;
    }

    public function phone(): ?string
    {
        return $this->phone;
    }

    public function password(): ?string
    {
        return $this->password;
    }
}

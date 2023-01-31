<?php

namespace App\ApplicationName\DataStore\User\Domain\DTO;

class UserRequest
{
    public function __construct(
        private string $email = '',
        private string $password = '',
    )
    {
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }
}

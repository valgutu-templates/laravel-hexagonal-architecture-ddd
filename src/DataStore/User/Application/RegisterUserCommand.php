<?php

namespace App\ApplicationName\DataStore\User\Application;

use App\ApplicationName\DataStore\User\Domain\DTO\UserRequest;
use App\ApplicationName\Shared\Domain\Command;

class RegisterUserCommand implements Command
{
    public function __construct(private UserRequest $userRequest)
    {
    }

    public function userRequest(): UserRequest
    {
        return $this->userRequest;
    }
}

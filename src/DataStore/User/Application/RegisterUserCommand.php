<?php

namespace App\ApplicationName\DataStore\User\Application;

use App\ApplicationName\DataStore\User\Domain\DTO\UserRequest;
use App\ApplicationName\DataStore\User\Domain\DTO\UserResponse;
use App\ApplicationName\DataStore\User\Domain\UserRepository;

class RegisterUserCommand
{
    public function __construct(private UserRepository $contract)
    {
    }

    public function execute(UserRequest $request): UserResponse
    {
        return $this->contract->create($request);
    }
}

<?php

namespace App\ApplicationName\Authentication\Infrastructure;

use App\ApplicationName\DataStore\User\Application\CreateUserCommand;
use App\ApplicationName\DataStore\User\Domain\DTO\UserRequest;
use App\ApplicationName\DataStore\User\Domain\DTO\UserResponse;

class DataStoreCreateUserCommand
{
    public function __construct(private CreateUserCommand $command)
    {
    }

    public function execute(UserRequest $request): UserResponse
    {
        $this->command->execute($request);
    }
}

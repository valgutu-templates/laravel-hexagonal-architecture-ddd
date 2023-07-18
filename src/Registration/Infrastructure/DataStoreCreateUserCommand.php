<?php

namespace App\ApplicationName\Registration\Infrastructure;

use App\ApplicationName\Registration\Domain\CreateUserCommand;
use App\ApplicationName\DataStore\User\Domain\DTO\UserRequest;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;
use App\ApplicationName\DataStore\User\Application\CreateUserCommand as CreateUserDataStoreCommand;

class DataStoreCreateUserCommand implements CreateUserCommand
{
    public function __construct(private CreateUserDataStoreCommand $command)
    {
    }

    public function execute(UserRequest $request): CommandResponse
    {
        return $this->command->execute($request);
    }
}

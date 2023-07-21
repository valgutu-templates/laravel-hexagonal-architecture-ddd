<?php

namespace App\ApplicationName\Authentication\Infrastructure;

use App\ApplicationName\Authentication\Domain\GetUserCommand;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;
use App\ApplicationName\DataStore\User\Application\GetUserByEmailCommand;

class DataStoreGetUserCommand implements GetUserCommand
{
    public function __construct(private GetUserByEmailCommand $command)
    {
    }

    public function execute(string $email): CommandResponse
    {
        return $this->command->execute($email);
    }
}

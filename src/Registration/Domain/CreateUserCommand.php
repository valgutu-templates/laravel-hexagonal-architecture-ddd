<?php

namespace App\ApplicationName\Registration\Domain;

use App\ApplicationName\DataStore\User\Domain\DTO\UserRequest;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

interface CreateUserCommand
{
    public function execute(UserRequest $request): CommandResponse;
}

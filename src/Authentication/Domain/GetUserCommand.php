<?php

namespace App\ApplicationName\Authentication\Domain;

use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

interface GetUserCommand
{
    public function execute(string $email): CommandResponse;
}

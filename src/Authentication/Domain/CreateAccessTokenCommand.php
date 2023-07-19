<?php

namespace App\ApplicationName\Authentication\Domain;

use App\ApplicationName\DataStore\AccessToken\Domain\DTO\AccessTokenRequest;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

interface CreateAccessTokenCommand
{
    public function execute(AccessTokenRequest $request): CommandResponse;
}

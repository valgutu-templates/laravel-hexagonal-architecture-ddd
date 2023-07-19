<?php

namespace App\ApplicationName\Authentication\Infrastructure;

use App\ApplicationName\Authentication\Domain\CreateAccessTokenCommand;
use App\ApplicationName\DataStore\AccessToken\Domain\DTO\AccessTokenRequest;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;
use App\ApplicationName\DataStore\AccessToken\Application\CreateAccessTokenCommand as DSCreateAccessTokenCommand;

class DataStoreCreateAccessTokenCommand implements CreateAccessTokenCommand
{
    public function __construct(private DSCreateAccessTokenCommand $command)
    {
    }

    public function execute(AccessTokenRequest $request): CommandResponse
    {
        return $this->command->execute($request);
    }
}

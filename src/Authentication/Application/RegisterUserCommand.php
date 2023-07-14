<?php

namespace App\ApplicationName\Authentication\Application;

use App\ApplicationName\Authentication\Domain\CreateUserCommand;
use App\ApplicationName\Authentication\Domain\DTO\AuthenticationRequest;
use App\ApplicationName\DataStore\User\Domain\DTO\UserRequest;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

class RegisterUserCommand
{
    public function __construct(
        private CreateUserCommand $command,
        private Authentication $authentication,
    )
    {
    }

    public function execute(UserRequest $request): CommandResponse
    {
        $response = $this->command->execute($request);

        if (201 === $response->getStatus()) {
            $response =  $this->authentication->auth(new AuthenticationRequest(
                $request->email(),
                $request->phone(),
                $request->password(),
            ));
        }

        return new CommandResponse(
            $response->getStatus(),
            $response->getData()
        );
    }
}

<?php

namespace App\ApplicationName\Authentication\Application;

use App\ApplicationName\Authentication\Domain\CreateUserCommand;
use App\ApplicationName\Authentication\Domain\DTO\AuthenticationRequest;
use App\ApplicationName\Authentication\Domain\DTO\RegistrationRequest;
use App\ApplicationName\Authentication\Domain\Validator\RegistrationValidator;
use App\ApplicationName\DataStore\User\Domain\DTO\UserRequest;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

class RegisterUserCommand
{
    public function __construct(
        private CreateUserCommand $command,
        private Authentication $authentication,
        private RegistrationValidator $registrationValidator,
    )
    {
    }

    public function execute(RegistrationRequest $request): CommandResponse
    {
        $validation = $this->registrationValidator->validate($request->toArray());
        if ($validation->isFailed()) {
            return new CommandResponse(400, $validation->jsonSerialize());
        }

        $response = $this->command->execute(new UserRequest(
            email: $request->email(),
            phone: $request->phone(),
            password: $request->password(),
        ));

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

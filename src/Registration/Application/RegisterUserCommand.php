<?php

namespace App\ApplicationName\Registration\Application;

use App\ApplicationName\Registration\Domain\CreateUserCommand;
use App\ApplicationName\Registration\Domain\DTO\RegistrationRequest;
use App\ApplicationName\Registration\Domain\Validator\RegistrationValidator;
use App\ApplicationName\DataStore\User\Domain\DTO\UserRequest;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

class RegisterUserCommand
{
    public function __construct(
        private CreateUserCommand $command,
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

        return $this->command->execute(new UserRequest(
            email: $request->email(),
            phone: $request->phone(),
            password: $request->password(),
        ));
    }
}

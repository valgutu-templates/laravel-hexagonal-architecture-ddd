<?php

namespace App\ApplicationName\DataStore\User\Application;

use App\ApplicationName\DataStore\User\Domain\DTO\UserRequest;
use App\ApplicationName\DataStore\User\Domain\UserRepository;
use App\ApplicationName\DataStore\User\Domain\Validator\UserValidator;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

class CreateUserCommand
{
    public function __construct(private UserRepository $repository, private UserValidator $userValidator)
    {
    }

    public function execute(UserRequest $request): CommandResponse
    {
        $validation = $this->userValidator->validate($request->toArray());
        if ($validation->isFailed()) {
            return new CommandResponse(400, $validation->jsonSerialize());
        }

        try {
            $response = $this->repository->create($request);

            return new CommandResponse(201, $response->toArray());
        } catch (\Exception $e) {
            return new CommandResponse(400, [
                'code'    => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }
}

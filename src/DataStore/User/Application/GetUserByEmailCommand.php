<?php

namespace App\ApplicationName\DataStore\User\Application;

use App\ApplicationName\DataStore\User\Domain\Exceptions\UserNotFoundException;
use App\ApplicationName\DataStore\User\Domain\UserRepository;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

class GetUserByEmailCommand
{
    public function __construct(
        private UserRepository $repository)
    {
    }

    public function execute(string $email): CommandResponse
    {
        try {
            $response = $this->repository->findByEmail($email);

            return new CommandResponse(200, $response->toArray(true));
        } catch (UserNotFoundException $e) {
            return new CommandResponse(404, [
                'code'    => $e->errorCode(),
                'message' => $e->errorMessage()
            ]);
        } catch (\Exception $e) {
            return new CommandResponse(400, [
                'code'    => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }
}

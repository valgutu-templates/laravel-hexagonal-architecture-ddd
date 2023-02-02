<?php

namespace App\ApplicationName\DataStore\User\Application;

use App\ApplicationName\DataStore\User\Domain\UserRepository;
use App\ApplicationName\Shared\CommandBus\Domain\Command;
use App\ApplicationName\Shared\CommandBus\Domain\CommandHandler;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;
use Symfony\Component\HttpFoundation\Response;

class RegisterUserCommandHandler implements CommandHandler
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function handle(Command $command): CommandResponse
    {
        $this->userRepository->create($command->userRequest());
        return new CommandResponse(true, Response::HTTP_CREATED, "User created successfully.");
    }
}

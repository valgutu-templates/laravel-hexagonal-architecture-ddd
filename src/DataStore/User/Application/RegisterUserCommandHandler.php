<?php

namespace App\ApplicationName\DataStore\User\Application;

use App\ApplicationName\DataStore\User\Domain\DTO\UserResponse;
use App\ApplicationName\DataStore\User\Domain\UserRepository;
use App\ApplicationName\Shared\Domain\CommandHandler;

class RegisterUserCommandHandler implements CommandHandler
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function handle(RegisterUserCommand $command): UserResponse
    {
        return $this->userRepository->create($command->userRequest());
    }
}

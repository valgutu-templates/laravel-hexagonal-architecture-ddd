<?php

namespace App\ApplicationName\DataStore\User\Infrastructure;

use App\ApplicationName\DataStore\User\Domain\DTO\UserRequest;
use App\ApplicationName\DataStore\User\Domain\DTO\UserResponse;
use App\ApplicationName\DataStore\User\Domain\UserRepository;

class EloquentUserRepository implements UserRepository
{
    public function create(UserRequest $userRequest): UserResponse
    {
        return new UserResponse();
    }
}

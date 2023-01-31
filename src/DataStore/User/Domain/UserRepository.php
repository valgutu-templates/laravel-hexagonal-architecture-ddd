<?php

namespace App\ApplicationName\DataStore\User\Domain;

use App\ApplicationName\DataStore\User\Domain\DTO\UserRequest;
use App\ApplicationName\DataStore\User\Domain\DTO\UserResponse;

interface UserRepository
{
    public function create(UserRequest $user): UserResponse;
}

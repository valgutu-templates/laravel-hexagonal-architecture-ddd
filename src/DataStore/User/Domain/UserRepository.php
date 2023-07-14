<?php

namespace App\ApplicationName\DataStore\User\Domain;

use App\ApplicationName\DataStore\User\Domain\DTO\UserRequest;
use App\ApplicationName\DataStore\User\Domain\DTO\UserResponse;

interface UserRepository
{
    public function create(UserRequest $request): UserResponse;

    public function update(UserRequest $request): UserResponse;

    public function get(int $id): UserResponse;

    public function all(): array;

    public function delete(int $id): bool;
}

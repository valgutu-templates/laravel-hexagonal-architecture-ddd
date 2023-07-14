<?php

namespace App\ApplicationName\DataStore\User\Infrastructure;

use App\ApplicationName\DataStore\User\Domain\DTO\UserRequest;
use App\ApplicationName\DataStore\User\Domain\DTO\UserResponse;
use App\ApplicationName\DataStore\User\Domain\Models\User;
use App\ApplicationName\DataStore\User\Domain\UserRepository;
use Illuminate\Support\Facades\Hash;

class EloquentUserRepository implements UserRepository
{
    public function create(UserRequest $request): UserResponse
    {
        $user = User::create($request->toArray());
        $user->password = Hash::make($request->password());
        $user->save();

        return new UserResponse($user->toArray());
    }

    public function update(UserRequest $request): UserResponse
    {
        $user = User::find($request->id());
        if (!$user) {

        }

        if (!is_null($request->firstName())) {
            $user->first_name = $request->firstName();
        }
        if (!is_null($request->lastName())) {
            $user->last_name = $request->lastName();
        }
        if (!is_null($request->email())) {
            $user->email = $request->email();
        }
        if (!is_null($request->phone())) {
            $user->phone = $request->phone();
        }
        if (!is_null($request->password())) {
            $user->password = Hash::make($request->password());
        }

        $user->save();

        return new UserResponse($user->toArray());
    }

    public function get(int $id): UserResponse
    {
        return new UserResponse();
    }

    public function all(): array
    {
        return [];
    }

    public function delete(int $id): bool
    {
        return false;
    }
}

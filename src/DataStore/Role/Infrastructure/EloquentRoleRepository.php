<?php

namespace App\ApplicationName\DataStore\Role\Infrastructure;

use App\ApplicationName\DataStore\Role\Domain\DTO\RoleResponse;
use App\ApplicationName\DataStore\Role\Domain\Exceptions\DefaultRoleNotFoundException;
use App\ApplicationName\DataStore\Role\Domain\Models\Role;
use App\ApplicationName\DataStore\Role\Domain\RoleRepository;

class EloquentRoleRepository implements RoleRepository
{
    public function getDefault(): RoleResponse
    {
        $role = Role::where('default', true)->first();
        if (!$role) {
            throw new DefaultRoleNotFoundException();
        }

        return new RoleResponse($role->toArray());
    }

    public function all(): array
    {
        return [];
    }
}

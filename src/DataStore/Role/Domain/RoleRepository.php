<?php

namespace App\ApplicationName\DataStore\Role\Domain;

use App\ApplicationName\DataStore\Role\Domain\DTO\RoleResponse;

interface RoleRepository
{
    public function getDefault(): RoleResponse;

    public function all(): array;
}

<?php

declare(strict_types=1);

namespace App\ApplicationName\DataStore\Role\Domain\Exceptions;

use DomainException;

class DefaultRoleNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'default_role_not_set';
    }

    public function errorMessage(): string
    {
        return sprintf('Default role is not set');
    }
}

<?php

declare(strict_types=1);

namespace App\ApplicationName\DataStore\User\Domain\Exceptions;

use DomainException;

class UserNotFoundException extends DomainException
{
    public function __construct(private string $id)
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'user_not_exist';
    }

    public function errorMessage(): string
    {
        return sprintf('User <%d> does not exist', $this->id);
    }
}

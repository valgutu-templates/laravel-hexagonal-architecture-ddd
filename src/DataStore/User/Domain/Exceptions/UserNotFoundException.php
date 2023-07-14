<?php

declare(strict_types=1);

namespace App\ApplicationName\DataStore\User\Domain\Exceptions;

use DomainException;

class UserNotFoundException extends DomainException
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'user_not_exist';
    }

    public function errorMessage(): string
    {
        return sprintf('The user id <%d> does not exist', $this->id);
    }
}

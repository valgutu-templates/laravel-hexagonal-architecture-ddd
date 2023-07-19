<?php

declare(strict_types=1);

namespace App\ApplicationName\DataStore\AccessToken\Domain\Exceptions;

use DomainException;

class AccessTokenNotFoundException extends DomainException
{
    public function __construct(private string $token)
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'access_token_not_exists';
    }

    public function errorMessage(): string
    {
        return sprintf('Access token <%d> does not exist', $this->token);
    }
}

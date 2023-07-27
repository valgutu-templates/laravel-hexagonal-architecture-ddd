<?php

declare(strict_types=1);

namespace App\ApplicationName\DataStore\EmailVerificationCode\Domain\Exceptions;

use DomainException;

class EmailVerificationCodeNotFoundException extends DomainException
{
    public function __construct(private string $verificationCode)
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'email_verification_code_not_found';
    }

    public function errorMessage(): string
    {
        return sprintf('Email verification code <%d> does not exist', $this->verificationCode);
    }
}

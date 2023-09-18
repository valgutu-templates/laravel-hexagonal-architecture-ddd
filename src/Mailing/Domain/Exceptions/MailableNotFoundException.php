<?php

declare(strict_types=1);

namespace App\ApplicationName\Mailing\Domain\Exceptions;

use DomainException;

class MailableNotFoundException extends DomainException
{
    public function __construct(private string $type)
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'mailable_not_exists';
    }

    public function errorMessage(): string
    {
        return sprintf('Mail <%d> does not exist', $this->type);
    }
}

<?php

namespace App\ApplicationName\Mailing\Infrastructure;

use App\ApplicationName\Mailing\Domain\Exceptions\MailableNotFoundException;
use App\ApplicationName\Mailing\Infrastructure\Mail\SendEmailVerificationMail;
use App\ApplicationName\Shared\Mailing\MailTypes;
use Illuminate\Contracts\Mail\Mailable;

class MailFactory
{
    public function __construct(
    )
    {
    }

    public function create(string $type, array $data): Mailable
    {
        return match ($type) {
            MailTypes::VERIFICATION_EMAIL => new SendEmailVerificationMail($data),
            default => throw new MailableNotFoundException($type),
        };
    }
}

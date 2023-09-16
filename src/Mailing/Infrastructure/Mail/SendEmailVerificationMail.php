<?php

namespace App\ApplicationName\Mailing\Infrastructure\Mail;

class SendEmailVerificationMail extends Mail
{
    protected const REQUIRED_PARAMETERS = ['code', 'user_id'];
    protected const SUBJECT = 'Account Verification';
    protected const VIEW_PATH = 'emails.verificationEmail';
}

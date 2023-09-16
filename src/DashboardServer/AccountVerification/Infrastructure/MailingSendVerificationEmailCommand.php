<?php

namespace App\ApplicationName\DashboardServer\AccountVerification\Infrastructure;

use App\ApplicationName\DashboardServer\AccountVerification\Domain\SendVerificationEmailCommand;
use App\ApplicationName\Mailing\Domain\DTO\SendEmailRequest;
use App\ApplicationName\Mailing\Application\SendEmailCommand;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;
use App\ApplicationName\Shared\Mailing\MailTypes;

class MailingSendVerificationEmailCommand implements SendVerificationEmailCommand
{
    private const EMAIL_TYPE = MailTypes::VERIFICATION_EMAIL;

    public function __construct(private SendEmailCommand $command)
    {
    }

    public function execute(string $toEmail, array $data = []): CommandResponse
    {
        return $this->command->execute(
            new SendEmailRequest(
                MailTypes::VERIFICATION_EMAIL,
                $toEmail,
                $data
            )
        );
    }
}

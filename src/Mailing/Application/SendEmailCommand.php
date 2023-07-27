<?php

namespace App\ApplicationName\Mailing\SendVerificationEmail\Application;

use App\ApplicationName\Mailing\Domain\DTO\SendEmailRequest;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

class SendEmailCommand
{
    public function execute(SendEmailRequest $request): CommandResponse
    {
    }
}

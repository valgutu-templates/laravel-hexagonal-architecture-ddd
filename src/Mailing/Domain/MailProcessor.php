<?php

namespace App\ApplicationName\Mailing\Domain;

use App\ApplicationName\Mailing\Domain\DTO\SendEmailRequest;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

interface MailProcessor
{
    public function process(SendEmailRequest $request): CommandResponse;
}

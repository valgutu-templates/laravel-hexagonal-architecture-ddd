<?php

namespace App\ApplicationName\DashboardServer\AccountVerification\Infrastructure;

use App\ApplicationName\DashboardServer\AccountVerification\Domain\SendVerificationEmailCommand;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

class MailingSendVerificationEmailCommand implements SendVerificationEmailCommand
{
    public function __construct()
    {
    }

    public function execute(): CommandResponse
    {
    }
}

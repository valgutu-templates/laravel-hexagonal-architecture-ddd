<?php

namespace App\ApplicationName\DashboardServer\AccountVerification\Domain;

use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

interface SendVerificationEmailCommand
{
    public function execute(): CommandResponse;
}

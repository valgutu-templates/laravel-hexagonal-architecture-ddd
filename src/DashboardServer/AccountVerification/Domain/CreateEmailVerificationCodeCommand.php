<?php

namespace App\ApplicationName\DashboardServer\AccountVerification\Domain;

use App\ApplicationName\DataStore\EmailVerificationCode\Domain\DTO\EmailVerificationCodeRequest;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

interface CreateEmailVerificationCodeCommand
{
    public function execute(EmailVerificationCodeRequest $request): CommandResponse;
}

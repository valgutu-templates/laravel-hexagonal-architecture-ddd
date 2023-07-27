<?php

namespace App\ApplicationName\DashboardServer\AccountVerification\Application;

use App\ApplicationName\DashboardServer\AccountVerification\Domain\EmailVerificationCodeProcessor;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

class SendEmailVerificationCommand
{
    public function __construct(
        private EmailVerificationCodeProcessor $emailVerificationCodeService
    )
    {
    }

    public function execute(int $userId): CommandResponse
    {
        return $this->emailVerificationCodeService->create($userId);
    }
}

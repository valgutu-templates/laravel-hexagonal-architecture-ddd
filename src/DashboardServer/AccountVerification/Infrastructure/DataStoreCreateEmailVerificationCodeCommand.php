<?php

namespace App\ApplicationName\DashboardServer\AccountVerification\Infrastructure;

use App\ApplicationName\DashboardServer\AccountVerification\Domain\CreateEmailVerificationCodeCommand;
use App\ApplicationName\DataStore\EmailVerificationCode\Domain\DTO\EmailVerificationCodeRequest;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;
use App\ApplicationName\DataStore\EmailVerificationCode\Application\CreateEmailVerificationCodeCommand as CreateEmailVerificationCodeCommandDataStore;

class DataStoreCreateEmailVerificationCodeCommand implements CreateEmailVerificationCodeCommand
{
    public function __construct(private CreateEmailVerificationCodeCommandDataStore $command)
    {
    }

    public function execute(EmailVerificationCodeRequest $request): CommandResponse
    {
        return $this->command->execute($request);
    }
}

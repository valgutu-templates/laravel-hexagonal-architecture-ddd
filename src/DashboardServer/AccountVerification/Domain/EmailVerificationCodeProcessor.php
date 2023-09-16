<?php

namespace App\ApplicationName\DashboardServer\AccountVerification\Domain;

use App\ApplicationName\DataStore\EmailVerificationCode\Domain\DTO\EmailVerificationCodeRequest;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;
use Carbon\Carbon;

class EmailVerificationCodeProcessor
{
    private const CODE_EXPIRATION_HOURS = 168;

    public function __construct(private CreateEmailVerificationCodeCommand $command)
    {
    }

    public function create(int $userId): CommandResponse
    {
        $code = $this->generate();
        return $this->save(new EmailVerificationCodeRequest(
            null,
            $userId,
            $code,
            Carbon::now()->addHours(static::CODE_EXPIRATION_HOURS)
        ));
    }

    private function save(EmailVerificationCodeRequest $request): CommandResponse
    {
        return $this->command->execute($request);
    }

    private function generate(): string
    {
        return rand(100000, 999999);
    }
}

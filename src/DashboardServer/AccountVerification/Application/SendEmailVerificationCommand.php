<?php

namespace App\ApplicationName\DashboardServer\AccountVerification\Application;

use App\ApplicationName\DashboardServer\AccountVerification\Domain\EmailVerificationCodeProcessor;
use App\ApplicationName\DashboardServer\AccountVerification\Domain\SendVerificationEmailCommand;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

class SendEmailVerificationCommand
{
    public function __construct(
        private EmailVerificationCodeProcessor $emailVerificationCodeService,
        private SendVerificationEmailCommand $sendEmailCommand,
    )
    {
    }

    public function execute(int $userId): CommandResponse
    {
        $response = $this->emailVerificationCodeService->create($userId);
        $statusCode = $response->getStatus();

        if (201 === $statusCode) {
            $toEmail = $response->getData()['to_email'] ?? null;
            $data = [
                'code' => $response->getData()['code'] ?? null,
                'user_id' => $response->getData()['user_id'] ?? null,
            ];

            $mailResponse = $this->sendEmailCommand->execute($toEmail, $data);

            dd($mailResponse);

            $responseData = ['status' => 'success'];
            return new CommandResponse($statusCode, $responseData);
        } else {
            return $response;
        }
    }
}

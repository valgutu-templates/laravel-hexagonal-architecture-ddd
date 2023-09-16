<?php

namespace App\ApplicationName\DataStore\EmailVerificationCode\Domain;

use App\ApplicationName\DataStore\EmailVerificationCode\Domain\DTO\EmailVerificationCodeRequest;
use App\ApplicationName\DataStore\EmailVerificationCode\Domain\DTO\EmailVerificationCodeResponse;

interface EmailVerificationCodeRepository
{
    public function create(EmailVerificationCodeRequest $request): EmailVerificationCodeResponse;

    public function find(EmailVerificationCodeRequest $request): EmailVerificationCodeResponse;

    public function delete(int $id): bool;
}

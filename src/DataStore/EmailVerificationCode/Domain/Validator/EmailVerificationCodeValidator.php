<?php

namespace App\ApplicationName\DataStore\EmailVerificationCode\Domain\Validator;

use App\ApplicationName\DataStore\EmailVerificationCode\Domain\DTO\EmailVerificationCodeRequest;
use App\ApplicationName\DataStore\EmailVerificationCode\Domain\EmailVerificationCodeRepository;
use App\ApplicationName\DataStore\EmailVerificationCode\Domain\Exceptions\EmailVerificationCodeNotFoundException;
use App\ApplicationName\Shared\Validation\Domain\DTO\ValidationResult;
use Carbon\Carbon;

class EmailVerificationCodeValidator
{
    private const EMAIL_DELAY_MIN = 0;

    public function __construct(
        private EmailVerificationCodeRepository $repository,
    )
    {
    }

    public function validate(array $data): ValidationResult
    {
        $validation = new ValidationResult();

        $field = 'user_id';
        if (!isset($data[$field])) {
            $validation->addError($field, 'Field is required.');
        } elseif (!$this->verifyEmailDelayPassed($data[$field])) {
            $validation->addError($field, sprintf('Email already sent. You can send a verification code email only once in %s minutes.', self::EMAIL_DELAY_MIN));
        }

        $field = 'code';
        if (!isset($data[$field])) {
            $validation->addError($field, 'Field is required.');
        } elseif (strlen($data[$field]) < 6) {
            $validation->addError($field, 'Should be at least 6 characters.');
        }

        return $validation;
    }

    private function verifyEmailDelayPassed(int $userId): bool
    {
        try {
            $row = $this->repository->find(new EmailVerificationCodeRequest(userId: $userId));

            $createdAt = Carbon::parse($row->createdAt());

            $diff = $createdAt->diffInSeconds(Carbon::now());

            return $diff > self::EMAIL_DELAY_MIN * 120;
        } catch (EmailVerificationCodeNotFoundException) {
            return true;
        }
    }
}

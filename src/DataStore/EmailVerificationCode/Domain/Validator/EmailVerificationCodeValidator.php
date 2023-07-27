<?php

namespace App\ApplicationName\DataStore\EmailVerificationCode\Domain\Validator;

use App\ApplicationName\Shared\Validation\Domain\DTO\ValidationResult;

class EmailVerificationCodeValidator
{
    public function __construct(
    )
    {
    }

    public function validate(array $data): ValidationResult
    {
        $validation = new ValidationResult();

        $field = 'user_id';
        if (!isset($data[$field])) {
            $validation->addError($field, 'Field is required.');
        }

        $field = 'code';
        if (!isset($data[$field])) {
            $validation->addError($field, 'Field is required.');
        } elseif (strlen($data[$field]) < 6) {
            $validation->addError($field, 'Should be at least 6 characters.');
        }

        return $validation;
    }
}

<?php

namespace App\ApplicationName\Mailing\Domain\Validator;

use App\ApplicationName\Shared\Validation\Domain\DTO\ValidationResult;
use App\ApplicationName\Shared\Validation\Validator;

class MailValidator
{
    public function __construct(
    )
    {
    }

    public function validate(array $data): ValidationResult
    {
        $validation = new ValidationResult();

        $field = 'type';
        if (!isset($data[$field]) || is_null($data[$field])) {
            $validation->addError($field, 'Field is required.');
        }

        $field = 'to_email';
        if (!isset($data[$field])) {
            $validation->addError($field, 'Field is required.');
        } elseif (!Validator::isEmail($data[$field])) {
            $validation->addError($field, 'Should be a valid email address.');
        }

        return $validation;
    }
}

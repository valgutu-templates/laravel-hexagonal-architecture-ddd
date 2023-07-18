<?php

namespace App\ApplicationName\Authentication\Domain\Validator;

use App\ApplicationName\Shared\Validation\Domain\DTO\ValidationResult;
use App\ApplicationName\Shared\Validation\Validator;

class AuthByEmailValidator
{
    public function validate(array $data): ValidationResult
    {
        $validation = new ValidationResult();

        $field = 'email';
        if (!isset($data[$field])) {
            $validation->addError($field, 'Field is required.');
        } elseif (!Validator::isEmail($data[$field])) {
            $validation->addError($field, 'Should be a valid email address.');
        }

        $field = 'password';
        if (!isset($data[$field])) {
            $validation->addError($field, 'Field is required.');
        } elseif (strlen($data[$field]) < 8) {
            $validation->addError($field, 'Password must contain at least 8 characters.');
        }

        return $validation;
    }
}

<?php

namespace App\ApplicationName\Authentication\Domain\Validator;

use App\ApplicationName\Shared\Validation\Domain\DTO\ValidationResult;

class RegistrationValidator
{
    public function validate(array $data): ValidationResult
    {
        $validation = new ValidationResult();

        $field = 'email';
        if (!isset($data[$field])) {
            $validation->addError($field, 'Field is required.');
        } elseif (!$this->isEmail($data[$field])) {
            $validation->addError($field, 'Should be a valid email address.');
        }

        $field = 'password';
        if (!isset($data[$field])) {
            $validation->addError($field, 'Field is required.');
        } elseif (strlen($data[$field]) < 8) {
            $validation->addError($field, 'Password must contain at least 8 characters.');
        }

        $field = 'password_confirmation';
        if (!isset($data[$field])) {
            $validation->addError($field, 'Field is required.');
        }

        if ($data['password'] !== $data['password_confirmation']) {
            $validation->addError('password_confirmation', 'Password and confirm password do NOT match.');
        }

        return $validation;
    }

    private function isEmail(string $email): bool
    {
        return true;
    }
}

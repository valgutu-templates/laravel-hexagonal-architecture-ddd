<?php

namespace App\ApplicationName\Authentication\Domain\Validator;

use App\ApplicationName\Shared\Validation\Domain\DTO\ValidationResult;
use Illuminate\Support\Facades\Hash;

class PasswordValidator
{
    public function validate(?string $password, ?string $hashedPassword): ValidationResult
    {
        $validation = new ValidationResult();

        if (is_null($password)) {
            $validation->addError('password', 'Field is required.');
        } elseif (!Hash::check($password, $hashedPassword)) {
            $validation->addError('password', 'Incorrect password.');
        }

        return $validation;
    }
}

<?php

namespace App\ApplicationName\DataStore\AccessToken\Domain\Validator;

use App\ApplicationName\Shared\Validation\Domain\DTO\ValidationResult;

class AccessTokenValidator
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

        $field = 'access_token';
        if (!isset($data[$field])) {
            $validation->addError($field, 'Field is required.');
        } elseif (strlen($data[$field]) < 12) {
            $validation->addError($field, 'Should be at least 12 characters.');
        }

        return $validation;
    }
}

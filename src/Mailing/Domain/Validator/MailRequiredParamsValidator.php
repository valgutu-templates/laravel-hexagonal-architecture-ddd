<?php

namespace App\ApplicationName\Mailing\Domain\Validator;

use App\ApplicationName\Shared\Validation\Domain\DTO\ValidationResult;

class MailRequiredParamsValidator
{
    public function validate(array $requiredParameters, array $data): ValidationResult
    {
        $validation = new ValidationResult();

        foreach ($requiredParameters as $field) {
            if (!isset($data[$field]) || is_null($data[$field])) {
                $validation->addError($field, 'Field is required.');
            }
        }

        return $validation;
    }
}

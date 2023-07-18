<?php

namespace App\ApplicationName\Shared\Validation;

class Validator
{
    static public function isEmail(string $email): bool
    {
        return str_contains($email, '@');
    }
}

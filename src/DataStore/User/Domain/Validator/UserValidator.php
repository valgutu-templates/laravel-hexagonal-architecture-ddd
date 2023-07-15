<?php

namespace App\ApplicationName\DataStore\User\Domain\Validator;

use App\ApplicationName\DataStore\User\Domain\Exceptions\UserNotFoundException;
use App\ApplicationName\DataStore\User\Domain\UserRepository;
use App\ApplicationName\Shared\Validation\Domain\DTO\ValidationResult;

class UserValidator
{
    public function __construct(
        private UserRepository $userRepository
    )
    {
    }

    public function validate(array $data): ValidationResult
    {
        $validation = new ValidationResult();

        $field = 'email';
        if (!isset($data[$field])) {
            $validation->addError($field, 'Field is required.');
        } elseif (!$this->isEmail($data[$field])) {
            $validation->addError($field, 'Should be a valid email address.');
        } elseif (!$this->emailIsUnique($data[$field])) {
            $validation->addError($field, sprintf('User with email address <%s> already exists.', $data[$field]));
        }

        $field = 'password';
        if (!isset($data[$field])) {
            $validation->addError($field, 'Field is required.');
        } elseif (strlen($data[$field]) < 8) {
            $validation->addError($field, 'Password must contain at least 8 characters.');
        }

        return $validation;
    }

    private function isEmail(string $email): bool
    {
        return str_contains($email, '@');
    }

    private function emailIsUnique(string $email): bool
    {
        try {
            $this->userRepository->findByEmail($email);
            return false;
        } catch (UserNotFoundException) {
            return true;
        }
    }
}

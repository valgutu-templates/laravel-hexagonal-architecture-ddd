<?php

namespace App\ApplicationName\Authentication\Domain\DTO;

class JWTRequest
{
    public function __construct(
        private int $userId
    )
    {
    }

    private function userId(): int
    {
        return $this->userId;
    }
}

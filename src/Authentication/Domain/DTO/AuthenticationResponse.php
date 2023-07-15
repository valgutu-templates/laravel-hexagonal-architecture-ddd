<?php

namespace App\ApplicationName\Authentication\Domain\DTO;

use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

class AuthenticationResponse extends CommandResponse
{
    public function __construct(
        private int $status,
        private array $data
    )
    {
        parent::__construct($status, $data);
    }
}

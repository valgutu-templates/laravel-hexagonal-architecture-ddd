<?php

namespace App\ApplicationName\Shared\CommandBus\Domain;

use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

interface CommandBus {
    public function handle(Command $command): CommandResponse;
}

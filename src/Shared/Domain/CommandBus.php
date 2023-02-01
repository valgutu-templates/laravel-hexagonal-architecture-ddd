<?php

namespace App\ApplicationName\Shared\Domain;

interface CommandBus {
    public function handle(Command $command);
}

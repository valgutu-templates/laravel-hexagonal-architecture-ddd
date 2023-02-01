<?php

namespace App\ApplicationName\Shared\Infrastructure;

use App\ApplicationName\Shared\Domain\Command;
use App\ApplicationName\Shared\Domain\CommandBus;

class SimpleCommandBus implements CommandBus
{
    public function handle(Command $command) {
        $handler = $this->resolveHandler(get_class($command));
        $handler($command);
    }

    private function resolveHandler(string $commandClassName): callable
    {

    }
}

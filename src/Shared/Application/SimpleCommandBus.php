<?php

namespace App\ApplicationName\Shared\Application;

use App\ApplicationName\Shared\Domain\Command;
use App\ApplicationName\Shared\Domain\CommandBus;
use App\ApplicationName\Shared\Domain\CommandHandler;
use App\ApplicationName\Shared\Domain\Exceptions\CommandNotExistException;
use mysql_xdevapi\Exception;

class SimpleCommandBus implements CommandBus
{
    private array $handlers = [];

    public function handle(Command $command) {
        try {
            $handler = $this->resolveHandler(get_class($command));
            $handler($command);
        } catch (CommandNotExistException $e) {
            throw new CommandNotExistException($e->getMessage());
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function registerHandler(string $commandName, CommandHandler $handler) {
        $this->handlers[$commandName] = [$handler, 'handle'];
    }

    private function resolveHandler(string $commandName): callable
    {
        if (!isset($this->handlers[$commandName])) {
            throw new CommandNotExistException($commandName);
        } else {
            return $this->handlers[$commandName];
        }
    }
}

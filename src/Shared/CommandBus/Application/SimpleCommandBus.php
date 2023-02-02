<?php

namespace App\ApplicationName\Shared\CommandBus\Application;

use App\ApplicationName\Shared\CommandBus\Domain\Command;
use App\ApplicationName\Shared\CommandBus\Domain\CommandBus;
use App\ApplicationName\Shared\CommandBus\Domain\CommandHandler;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;
use App\ApplicationName\Shared\CommandBus\Domain\Exceptions\CommandNotExistException;
use Symfony\Component\HttpFoundation\Response;


class SimpleCommandBus implements CommandBus
{
    private array $handlers = [];

    public function handle(Command $command): CommandResponse
    {
        try {
            $handler = $this->resolveHandler(get_class($command));
            return $handler($command);
        } catch (CommandNotExistException $e) {
            return new CommandResponse(
                false,
                Response::HTTP_INTERNAL_SERVER_ERROR,
                $e->errorMessage()
            );
        }
    }

    public function registerHandler(string $commandName, CommandHandler $handler): void
    {
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

<?php

namespace App\ApplicationName\Shared\CommandBus\Domain\Exceptions;

class CommandNotExistException extends \Exception
{
    public function __construct(private string $commandClassName = '')
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'command_not_exist';
    }

    public function errorMessage(): string
    {
        return sprintf('The command <%s> does not exist', $this->commandClassName);
    }
}

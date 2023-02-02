<?php

namespace App\Http\Controllers\User;

use App\ApplicationName\DataStore\User\Application\RegisterUserCommand;
use App\ApplicationName\DataStore\User\Domain\DTO\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class RegisterUserAction extends Controller
{
    public function __construct(
        protected RegisterUserCommand $command
    )
    {
    }

    public function __invoke(): JsonResponse
    {
        $commandResponse = $this->commandBus()->handle(
            new RegisterUserCommand(new UserRequest(
                'valery@test.com',
                'mypassword'
            ))
        );

        if ($commandResponse->success()) {
            return $this->jsonResponse(statusCode: 201);
        } else {
            return $this->jsonResponse(
                data: [
                    'error' => $commandResponse->message(),
                ],
                statusCode: $commandResponse->statusCode()
            );
        }
    }
}

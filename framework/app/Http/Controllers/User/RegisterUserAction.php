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
        $this->commandBus()->handle(
            new RegisterUserCommand(new UserRequest(
                'valery@test.com',
                'mypassword'
            ))
        );

        return $this->successResponse([
            'hi' => true
        ]);
    }
}

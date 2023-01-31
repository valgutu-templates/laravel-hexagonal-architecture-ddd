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
        $this->command->execute(new UserRequest(
            'valery@gmail.com',
            'mypassword',
        ));
        return $this->successResponse([
            'hi' => true
        ]);
    }
}

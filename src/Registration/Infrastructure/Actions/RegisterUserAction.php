<?php

namespace App\ApplicationName\Registration\Infrastructure\Actions;

use App\ApplicationName\Registration\Application\RegisterUserCommand;
use App\ApplicationName\Registration\Domain\DTO\RegistrationRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterUserAction extends Controller
{
    public function __construct(
        protected RegisterUserCommand $command
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $response = $this->command->execute(new RegistrationRequest(
            email: $request->input('email'),
            phone: $request->input('phone'),
            password: $request->input('password'),
            passwordConfirmation: $request->input('password_confirmation'),
        ));

        return $this->jsonResponse($response->getStatus(), $response->getData());
    }
}

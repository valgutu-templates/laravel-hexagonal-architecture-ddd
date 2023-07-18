<?php

namespace App\ApplicationName\Authentication\Infrastructure\Actions;

use App\ApplicationName\Authentication\Application\Authentication;
use App\ApplicationName\Authentication\Domain\DTO\AuthenticationRequest;
use App\ApplicationName\Registration\Application\RegisterUserCommand;
use App\ApplicationName\Registration\Domain\DTO\RegistrationRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthAction extends Controller
{
    public function __construct(
        protected Authentication $authentication
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $response = $this->authentication->authByEmail(new AuthenticationRequest(
            email: $request->input('email'),
            password: $request->input('password'),
        ));

        return $this->jsonResponse($response->getStatus(), $response->getData());
    }
}

<?php

namespace App\ApplicationName\Authentication\Infrastructure\Actions;

use App\ApplicationName\Authentication\Application\RegisterUserCommand;
use App\ApplicationName\DataStore\User\Domain\DTO\UserRequest;
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
        $response = $this->command->execute(new UserRequest(
            null,
            $request->input('email'),
            $request->input('phone'),
            $request->input('password')
        ));

        return $this->jsonResponse($response->getStatus(), $response->getData());
    }
}

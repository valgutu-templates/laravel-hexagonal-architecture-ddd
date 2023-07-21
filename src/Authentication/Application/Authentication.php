<?php

namespace App\ApplicationName\Authentication\Application;

use App\ApplicationName\Authentication\Domain\AccessToken;
use App\ApplicationName\Authentication\Domain\DTO\AuthenticationRequest;
use App\ApplicationName\Authentication\Domain\DTO\AuthenticationResponse;
use App\ApplicationName\Authentication\Domain\GetUserCommand;
use App\ApplicationName\Authentication\Domain\PasswordChecker;
use App\ApplicationName\Authentication\Domain\Validator\AuthByEmailValidator;
use App\ApplicationName\Authentication\Domain\Validator\PasswordValidator;

class Authentication
{
    public function __construct(
        private AuthByEmailValidator $authByEmailValidator,
        private AccessToken $accessToken,
        private GetUserCommand $getUserCommand,
        private PasswordValidator $passwordValidator,
    )
    {
    }

    public function authByEmail(AuthenticationRequest $requests): AuthenticationResponse
    {
        $validation = $this->authByEmailValidator->validate($requests->toArray());
        if ($validation->isFailed()) {
            return new AuthenticationResponse(400, $validation->jsonSerialize());
        }

        $userResponse = $this->getUserCommand->execute($requests->email());
        if (404 === $userResponse->getStatus()) {
            return new AuthenticationResponse(404, $userResponse->getData());
        }

        // check password
        $user = $userResponse->getData();
        $passwordValidation = $this->passwordValidator->validate($requests->password(), $user['password'] ?? null);
        if ($passwordValidation->isFailed()) {
            return new AuthenticationResponse(403, [
                'status' => 'error',
                'message' => 'Unauthorized',
                'errors' => $passwordValidation->errors()
            ]);
        }

        // generate access token
        $response = $this->accessToken->create($user['id'] ?? null);

        return new AuthenticationResponse(200, [
            'access_token' => $response->accessToken(),
            'expires_at' => $response->expiresAt(),
        ]);
    }
}

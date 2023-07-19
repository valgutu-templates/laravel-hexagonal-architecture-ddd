<?php

namespace App\ApplicationName\Authentication\Application;

use App\ApplicationName\Authentication\Domain\AccessToken;
use App\ApplicationName\Authentication\Domain\DTO\AuthenticationRequest;
use App\ApplicationName\Authentication\Domain\DTO\AuthenticationResponse;
use App\ApplicationName\Authentication\Domain\Validator\AuthByEmailValidator;

class Authentication
{
    public function __construct(
        private AuthByEmailValidator $authByEmailValidator,
        private AccessToken $accessToken,
    )
    {
    }

    public function authByEmail(AuthenticationRequest $requests): AuthenticationResponse
    {
        $validation = $this->authByEmailValidator->validate($requests->toArray());
        if ($validation->isFailed()) {
            return new AuthenticationResponse(400, $validation->jsonSerialize());
        }

        // check credentials
        // ...

        // generate access token
        $response = $this->accessToken->create(1);

        return new AuthenticationResponse(200, [
            'access_token' => $response->accessToken(),
            'expires_at' => $response->expiresAt(),
        ]);
    }
}

<?php

namespace App\ApplicationName\Authentication\Domain;

use App\ApplicationName\Authentication\Domain\DTO\AccessTokenResponse;
use App\ApplicationName\DataStore\AccessToken\Domain\DTO\AccessTokenRequest;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

class AccessToken
{
    public function __construct(
        private CreateAccessTokenCommand $createAccessTokenCommand
    )
    {
    }

    public function create(int $userId): AccessTokenResponse
    {
        $token = $this->generate();
        $response = $this->save(new AccessTokenRequest(
            null,
            $userId,
            $token
        ));
        return new AccessTokenResponse($response->getData());
    }

    private function save(AccessTokenRequest $request): CommandResponse
    {
        return $this->createAccessTokenCommand->execute($request);
    }

    private function generate(): string
    {
        return hash('sha256', uniqid().rand(1000000, 9999999));
    }
}

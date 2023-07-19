<?php

namespace App\ApplicationName\DataStore\AccessToken\Application;

use App\ApplicationName\DataStore\AccessToken\Domain\AccessTokenRepository;
use App\ApplicationName\DataStore\AccessToken\Domain\DTO\AccessTokenRequest;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

class FindAccessTokenByUserCommand
{
    public function __construct(
        private AccessTokenRepository $repository,
    )
    {
    }

    public function execute(AccessTokenRequest $request): CommandResponse
    {
        try {
            $response = $this->repository->findByUser($request);

            return new CommandResponse(200, $response->toArray());
        } catch (\Exception $e) {
            return new CommandResponse(400, [
                'code'    => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }
}

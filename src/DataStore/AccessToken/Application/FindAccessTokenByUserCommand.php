<?php

namespace App\ApplicationName\DataStore\AccessToken\Application;

use App\ApplicationName\DataStore\AccessToken\Domain\VerificationCodeRepository;
use App\ApplicationName\DataStore\AccessToken\Domain\DTO\VerificationCodeRequest;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

class FindAccessTokenByUserCommand
{
    public function __construct(
        private VerificationCodeRepository $repository,
    )
    {
    }

    public function execute(VerificationCodeRequest $request): CommandResponse
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

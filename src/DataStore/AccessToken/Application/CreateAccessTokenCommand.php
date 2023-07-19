<?php

namespace App\ApplicationName\DataStore\AccessToken\Application;

use App\ApplicationName\DataStore\AccessToken\Domain\AccessTokenRepository;
use App\ApplicationName\DataStore\AccessToken\Domain\DTO\AccessTokenRequest;
use App\ApplicationName\DataStore\AccessToken\Domain\Validator\AccessTokenValidator;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

class CreateAccessTokenCommand
{
    public function __construct(
        private AccessTokenRepository $repository,
        private AccessTokenValidator $validator
    )
    {
    }

    public function execute(AccessTokenRequest $request): CommandResponse
    {
        $validation = $this->validator->validate($request->toArray());
        if ($validation->isFailed()) {
            return new CommandResponse(400, $validation->jsonSerialize());
        }

        try {
            $response = $this->repository->create($request);

            return new CommandResponse(201, $response->toArray());
        } catch (\Exception $e) {
            return new CommandResponse(400, [
                'code'    => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }
}

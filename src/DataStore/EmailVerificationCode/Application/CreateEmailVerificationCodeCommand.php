<?php

namespace App\ApplicationName\DataStore\EmailVerificationCode\Application;

use App\ApplicationName\DataStore\EmailVerificationCode\Domain\EmailVerificationCodeRepository;
use App\ApplicationName\DataStore\EmailVerificationCode\Domain\DTO\EmailVerificationCodeRequest;
use App\ApplicationName\DataStore\EmailVerificationCode\Domain\Validator\EmailVerificationCodeValidator;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

class CreateEmailVerificationCodeCommand
{
    public function __construct(
        private EmailVerificationCodeRepository $repository,
        private EmailVerificationCodeValidator $validator
    )
    {
    }

    public function execute(EmailVerificationCodeRequest $request): CommandResponse
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

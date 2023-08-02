<?php

namespace App\ApplicationName\Mailing\Application;

use App\ApplicationName\Mailing\Domain\DTO\SendEmailRequest;
use App\ApplicationName\Mailing\Domain\MailProcessor;
use App\ApplicationName\Mailing\Domain\Validator\MailValidator;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

class SendEmailCommand
{
    public function __construct(
        private MailValidator $validator,
        private MailProcessor $mailProcessor,
    )
    {

    }

    public function execute(SendEmailRequest $request): CommandResponse
    {
        $validation = $this->validator->validate($request->toArray());

        if ($validation->isFailed()) {
            return new CommandResponse(400, $validation->jsonSerialize());
        }

        return $this->mailProcessor->process($request);
    }
}

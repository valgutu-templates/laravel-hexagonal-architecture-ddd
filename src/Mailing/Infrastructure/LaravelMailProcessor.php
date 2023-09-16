<?php

namespace App\ApplicationName\Mailing\Infrastructure;

use App\ApplicationName\Mailing\Domain\DTO\SendEmailRequest;
use App\ApplicationName\Mailing\Domain\MailProcessor;
use App\ApplicationName\Mailing\Domain\Validator\MailRequiredParamsValidator;
use App\ApplicationName\Shared\CommandBus\Domain\DTO\CommandResponse;

class LaravelMailProcessor implements MailProcessor
{
    public function __construct(
        private MailFactory $mailFactory,
        private MailRequiredParamsValidator $validator,
    )
    {
    }

    public function process(SendEmailRequest $request): CommandResponse
    {
        $mailable = $this->mailFactory->create($request->type(), $request->data());

        $validation = $this->validator->validate($mailable->requiredParameters(), $request->data());

        if ($validation->isFailed()) {
            return new CommandResponse(400, $validation->jsonSerialize());
        }

        dispatch(new SendMailJob($mailable, $request->toEmail()));

        return new CommandResponse(200);
    }
}

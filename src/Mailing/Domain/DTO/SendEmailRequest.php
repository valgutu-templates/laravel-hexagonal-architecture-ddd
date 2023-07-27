<?php

namespace App\ApplicationName\Mailing\Domain\DTO;

class SendEmailRequest
{
    public function __construct(
        private ?string $type = null,
        private ?string $toEmail = null,
        private ?array $data = []
    )
    {

    }

}

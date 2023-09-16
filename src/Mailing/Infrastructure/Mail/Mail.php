<?php

namespace App\ApplicationName\Mailing\Infrastructure\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mail extends Mailable
{
    use Queueable, SerializesModels;

    protected const REQUIRED_PARAMETERS = [];
    protected const SUBJECT = '';
    protected const VIEW_PATH = '';
    protected array $payload = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $payload = [])
    {
        $this->payload = $payload;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(static::SUBJECT)->markdown(static::VIEW_PATH, $this->payload);
    }

    public function requiredParameters(): array
    {
        return static::REQUIRED_PARAMETERS;
    }
}

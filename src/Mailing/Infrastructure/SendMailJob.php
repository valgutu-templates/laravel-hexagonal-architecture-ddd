<?php

namespace App\ApplicationName\Mailing\Infrastructure;

use App\ApplicationName\DashboardServer\AccountVerification\Domain\DTO\SendEmailRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private SendEmailRequest $request)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    }
}

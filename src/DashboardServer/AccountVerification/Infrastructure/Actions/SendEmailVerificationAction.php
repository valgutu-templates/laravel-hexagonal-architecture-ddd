<?php

namespace App\ApplicationName\DashboardServer\AccountVerification\Infrastructure\Actions;

use App\ApplicationName\DashboardServer\AccountVerification\Application\SendEmailVerificationCommand;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SendEmailVerificationAction extends Controller
{
    public function __construct(
        private SendEmailVerificationCommand $command,
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $response = $this->command->execute($request->route('id'));

        return $this->jsonResponse($response->getStatus(), $response->getData());
    }
}

<?php

namespace App\Http\Controllers;

use App\ApplicationName\Shared\CommandBus\Domain\CommandBus;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function commandBus(): CommandBus
    {
        return app(CommandBus::class);
    }

    final protected function jsonResponse(?array $data = null, int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse($data, $statusCode);
    }
}

<?php

namespace App\Http\Controllers;

use App\ApplicationName\Shared\Application\SimpleCommandBus;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function commandBus(): SimpleCommandBus
    {
        return app(SimpleCommandBus::class);
    }

    final protected function successResponse(?array $data = null, int $statusCode = Response::HTTP_OK): JsonResponse
    {
        $response['success'] = true;
        $response['data'] = $data;
        return $this->jsonResponse($response, $statusCode);
    }

    final protected function errorResponse(string $errorMessage = null, int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        $response['success'] = false;
        $response['error'] = $errorMessage;
        return $this->jsonResponse($response, $statusCode);
    }

    final protected function jsonResponse(?array $data = null, int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse($data, $statusCode);
    }
}

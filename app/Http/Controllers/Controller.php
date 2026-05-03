<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Return formatted successful responses
     *
     * @param  array  $headers
     * @return Illuminate\Http\JsonResponse
     */
    public function sendResponse(array $data, int $code = 200, $headers = []): JsonResponse
    {
        return response()->json($this->formatResponse($data), $code)->withHeaders($headers);
    }

    /**
     * Return formatted error responses
     *
     * @param  array  $headers
     * @return Response
     */
    public function sendError(array $data, int $code = 500, $headers = []): JsonResponse
    {
        return response()->json($this->formatResponse($data, 'error'), $code)->withHeaders($headers);
    }

    /**
     * Format API response
     *
     * @return array [(string)'status', (array)'data']
     */
    private function formatResponse(array $data = [], string $status = 'success'): array
    {
        return [
            'status' => $status,
            'data' => $data,
        ];
    }
}

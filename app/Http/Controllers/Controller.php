<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Return formatted successful responses
     *
     * @param array $data
     * @param integer $code
     * @param array $headers
     * @return Illuminate\Http\JsonResponse
     */
    public function sendResponse(array $data, int $code = 200, $headers = []) : JsonResponse
    {
       return response()->json($this->formatResponse($data), $code)->withHeaders($headers);
    }

    /**
     * Return formatted error responses
     *
     * @param array $data
     * @param integer $code
     * @param array $headers
     * @return \Illuminate\Http\Response
     */
    public function sendError(array $data, int $code = 500, $headers = []) : JsonResponse
    {
       return response()->json($this->formatResponse($data, 'error'), $code)->withHeaders($headers);
    }

    /**
     * Format API response
     *
     * @param array $data
     * @param string $status
     * @return array [(string)'status', (array)'data']
     */
    private function formatResponse(array $data = [], string $status = 'success'):array
    {
        return [
            'status' => $status,
            'data' => $data
        ];
    }
}

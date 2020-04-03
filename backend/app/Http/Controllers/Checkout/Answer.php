<?php

namespace App\Http\Controllers\Checkout;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Trait Answer
 *
 * @package App\Http\Controllers\Checkout
 */
trait Answer
{
    /**
     * @param mixed $data
     *
     * @return Response
     */
    protected function success($data): Response
    {
        return response(['status' => 'success', 'data' => $data]);
    }

    /**
     * @param array $data
     * @param bool $raw
     *
     * @return Response
     */
    protected function fail(array $data, $raw = false): Response
    {
        if ($raw) {
            return response($data, 400);
        }
        return response(['status' => 'fail', 'data' => $data], 400);
    }

    /**
     * @param Throwable $error
     * @param array $data
     *
     * @return Response
     */
    private function error(Throwable $error, $data = []): Response
    {
        $context = [
            'payload' => $data,
            'file' => $error->getFile(),
            'line' => $error->getLine(),
            'code' => $error->getCode(),
            'trace' => $error->getTraceAsString(),
        ];
        Log::emergency($error->getMessage(), $context);
        return response(['status' => 'error', 'data' => ['error' => 'internal']], 500);
    }
}
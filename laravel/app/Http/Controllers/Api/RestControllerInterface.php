<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Interface RestControllerInterface
 *
 * @package App\Http\Controllers\Api
 */
interface RestControllerInterface
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse;

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse;

    /**
     * @param Request $request
     * @param string $id
     *
     * @return JsonResponse
     */
    public function read(Request $request, string $id): JsonResponse;

    /**
     * @param Request $request
     * @param string $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, string $id): JsonResponse;

    /**
     * @param Request $request
     * @param string $id
     *
     * @return JsonResponse
     */
    public function delete(Request $request, string $id): JsonResponse;

    /**
     * @param Request $request
     * @param string $id
     *
     * @return JsonResponse
     */
    public function restore(Request $request, string $id): JsonResponse;
}

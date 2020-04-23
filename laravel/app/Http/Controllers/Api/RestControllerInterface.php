<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Exceptions\ErrorExternalIntegration;
use App\Exceptions\ErrorResourceIsGone;
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
     * @throws ErrorResourceIsGone
     */
    public function read(Request $request, string $id): JsonResponse;

    /**
     * @param Request $request
     * @param string $id
     *
     * @return JsonResponse
     * @throws ErrorResourceIsGone
     */
    public function update(Request $request, string $id): JsonResponse;

    /**
     * @param Request $request
     * @param string $id
     *
     * @return JsonResponse
     * @throws ErrorResourceIsGone
     */
    public function destroy(Request $request, string $id): JsonResponse;

    /**
     * @param Request $request
     * @param string $id
     *
     * @return JsonResponse
     * @throws ErrorResourceIsGone
     */
    public function restore(Request $request, string $id): JsonResponse;

    /**
     * @param string $id
     * @param array $data
     *
     * @return array
     * @throws ErrorExternalIntegration
     */
    public function prepareRecord(string $id, array $data): array;
}

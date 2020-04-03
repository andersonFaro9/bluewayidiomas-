<?php

namespace App\Http\Controllers\Api\Gateway;

use App\Domains\Gateway\Transaction\TransactionRepository;
use App\Exceptions\ErrorRuntime;
use App\Http\Controllers\Api\AbstractRestController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class TransactionController
 * @package App\Http\Controllers\Api\Gateway
 */
class TransactionController extends AbstractRestController
{
    /**
     * TransactionController constructor.
     * @param TransactionRepository $repository
     * @param Request $request
     */
    public function __construct(TransactionRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }

    /**
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     * @throws ErrorRuntime
     */
    public function update(Request $request, string $id): JsonResponse
    {
        throw new ErrorRuntime(['update' => 'invalid']);
    }
}

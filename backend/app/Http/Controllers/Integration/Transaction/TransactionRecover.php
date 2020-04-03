<?php

namespace App\Http\Controllers\Integration\Transaction;

use App\Domains\Gateway\Transaction\TransactionRepository;
use App\Exceptions\ErrorInvalidArgument;

/**
 * Class TransactionRecover
 * @package App\Http\Controllers\Integration\Transaction
 */
class TransactionRecover extends AbstractTransaction
{
    /**
     * @param TransactionRepository $repository
     * @param string $id
     * @return mixed
     * @throws ErrorInvalidArgument
     */
    protected function handler(TransactionRepository $repository, string $id)
    {
        return $repository->read($id);
    }
}
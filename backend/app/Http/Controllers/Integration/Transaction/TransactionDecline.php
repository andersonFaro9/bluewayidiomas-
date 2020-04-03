<?php

namespace App\Http\Controllers\Integration\Transaction;

use App\Domains\Gateway\Transaction;
use App\Domains\Gateway\Transaction\TransactionRepository;
use App\Exceptions\ErrorRuntime;
use App\Exceptions\ErrorValidation;

/**
 * Class TransactionDecline
 * @package App\Http\Controllers\Integration\Transaction
 */
class TransactionDecline extends AbstractTransaction
{
    /**
     * @param TransactionRepository $repository
     * @param string $id
     * @return mixed
     * @throws ErrorValidation
     * @throws ErrorRuntime
     */
    protected function handler(TransactionRepository $repository, string $id)
    {
        /** @var Transaction $transaction */
        $transaction = $repository->read($id);
        if ($transaction->getValue('status') !== Transaction::STATUS_PENDING) {
            throw new ErrorValidation([]);
        }
        if ($repository->decline($transaction, $this->request->all())) {
            return ['status' => 'success'];
        }
        throw new ErrorRuntime([]);
    }
}

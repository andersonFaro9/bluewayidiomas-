<?php

namespace App\Domains\Gateway\Transaction;

use App\Domains\Gateway\Transaction;

use function App\Helper\url;

/**
 * Class TransactionCreating
 *
 * @package App\Domains\Gateway\Transaction
 */
class TransactionCreating
{
    /**
     * TransactionCreated constructor.
     *
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $transaction->setValue('status', Transaction::STATUS_PENDING);
    }
}

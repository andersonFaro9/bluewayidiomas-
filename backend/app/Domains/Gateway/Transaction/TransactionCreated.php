<?php

namespace App\Domains\Gateway\Transaction;

use App\Domains\Admin\User\UserRepository;
use App\Domains\Gateway\Transaction;
use App\Units\Mail\Sender;
use Illuminate\Support\Facades\Lang;

/**
 * Class TransactionCreated
 *
 * @package App\Domains\Gateway\Transaction
 */
class TransactionCreated
{
    /**
     * TransactionCreated constructor.
     *
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->notify($transaction);
    }

    /**
     * @param Transaction $transaction
     *
     * @return void
     */
    private function notify(Transaction $transaction): void
    {
        $admins = UserRepository::instance()->getAdmins();
        $subject = Lang::trans('gateway/transaction/message.created');

        $template = 'gateway.transaction.created';
        $payload = ['merchant' => $transaction->user()->name];

        Sender::instance(['template' => $template, 'payload' => $payload])
            ->subject($subject)
            ->dispatch($admins->pluck('email')->toArray());
    }
}

<?php

namespace App\Domains\Gateway\Transaction;

use App\Domains\Admin\User\UserRepository;
use App\Domains\Gateway\Transaction;
use App\Units\Mail\Sender;
use Illuminate\Support\Facades\Lang;

/**
 * Class TransactionUpdated
 *
 * @package App\Domains\Gateway\Transaction
 */
class TransactionUpdated
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
        $merchant = $transaction->owner->getValue('name');

        $subject = Lang::trans('gateway/transaction/message.updated');
        $status = Lang::trans("gateway/transaction/message.status.{$transaction->getValue('status')}");

        $template = 'gateway.transaction.updated';
        $payload = array_merge(['merchant' => $merchant, 'status' => $status], $transaction->getValues());

        Sender::instance(['template' => $template, 'payload' => $payload])
            ->subject($subject)
            ->dispatch($admins->pluck('email')->toArray());
    }
}

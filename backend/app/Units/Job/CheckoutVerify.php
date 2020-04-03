<?php

namespace App\Units\Job;

use App\Domains\Gateway\Transaction;
use App\Domains\Gateway\Transaction\TransactionRepository;
use App\Http\Controllers\Checkout\Integrator;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Bus\PendingDispatch;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class CheckoutVerify
 *
 * @package App\Units\Job
 */
class CheckoutVerify implements ShouldQueue
{
    /**
     * @traits
     */
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use Integrator;

    /**
     * @var TransactionRepository
     */
    private $transactionRepository;

    /**
     * @var string
     */
    private $id;

    /**
     * @var int
     */
    private $attemptMinutesDelay;

    /**
     * @var int
     */
    private $attempts;

    /**
     * TransactionCheckStatus constructor.
     *
     * @param string $id
     * @param int $delay
     * @param int $attempts
     */
    public function __construct(string $id, int $delay, int $attempts = 0)
    {
        $this->transactionRepository = TransactionRepository::instance();
        $this->id = $id;
        $this->attemptMinutesDelay = $delay;
        $this->attempts = $attempts;
    }

    /**
     * @param string $id
     * @param int $attempts
     *
     * @return PendingDispatch
     */
    public static function attempt(
        string $id,
        int $attempts = 0
    ): PendingDispatch {
        // get the env value to delay
        $delay = env('CHECKOUT_ATTEMPT_MINUTES_DELAY', 1);

        // add job on queue
        return static::dispatch($id, $delay, $attempts)
            ->delay(now()->addMinutes($delay))
            ->onQueue('generic');
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws GuzzleException
     */
    public function handle(): void
    {
        // get transaction with id passed on construct
        $transaction = $this->transactionRepository->findById($this->id);
        if ($transaction->getValue('status') !== Transaction::STATUS_PENDING) {
            // if is not pending anymore the verification is not necessary anymore
            return;
        }

        // increase attempts
        $this->attempts++;

        // update transaction verification attempts
        $transaction->setValue('attempts', $this->attempts)->save();

        // get the env value to total time to attempt
        $total = env('CHECKOUT_ATTEMPT_MINUTES_TOTAL', 240);
        // calculate the max of attempts
        $max = $total / $this->attemptMinutesDelay;

        // if attempts is more than max...
        if ($this->attempts >= $max) {
            // we can expire the transaction
            $this->transactionRepository->expire($transaction);
            // verification is not necessary anymore
            return;
        }

        // get status from integration
        $status = $this->statusIntegration($transaction);

        // apply the change on transaction
        $apply = $this->transactionRepository->applyStatus($transaction, $status);

        // if the got status was valid ...
        if ($apply) {
            // then our job is finished
            return;
        }

        // if the got status still pending add the job on queue again
        // a recursive call was executed above, the process will be executed again after the delay
        static::attempt($this->id, $this->attempts);
    }
}

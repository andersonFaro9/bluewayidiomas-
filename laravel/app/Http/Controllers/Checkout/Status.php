<?php

namespace App\Http\Controllers\Checkout;

use App\Domains\Gateway\Transaction;
use App\Domains\Gateway\Transaction\TransactionRepository;
use App\Http\Controllers\Controller;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Php\Text;
use Throwable;

/**
 * Class Status
 *
 * @package App\Http\Controllers\Checkout
 */
class Status extends Controller
{
    /**
     * @traits
     */
    use Integrator;
    use Answer;

    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @param Request $request
     * @param string $id
     * @param TransactionRepository $transactionRepository
     *
     * @return mixed
     * @throws Exception
     * @throws GuzzleException
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke(Request $request, string $id, TransactionRepository $transactionRepository)
    {
        try {
            /** @var Transaction $transaction */
            $transaction = $transactionRepository->read($id);
        } catch (Throwable $error) {
            return $this->error($error, ['transactionId' => $id]);
        }

        // check if status is not pending
        if ($transaction->getValue('status') !== States::STATE_PENDING) {
            // if is not pending returns the current state
            return ['id' => $id, 'status' => $transaction->getValue('status')];
        }

        // well, if still pending lets check how is it on integrator
        $status = $this->statusIntegration($transaction);
        // apply the change on transaction
        if ($transactionRepository->applyStatus($transaction, $status)) {
            // if applied returns the status applied
            return ['id' => $id, 'status' => $transaction->getValue('status')];
        }

        // returns the status as pending
        return ['id' => $id, 'status' => States::STATE_PENDING];
    }
}

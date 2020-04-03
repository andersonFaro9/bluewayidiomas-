<?php

namespace App\Http\Controllers\Checkout;

use App\Domains\Gateway\Transaction;
use App\Domains\Gateway\Transaction\TransactionRepository;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

use function App\Helper\url;

/**
 * Class Confirm
 *
 * @package App\Http\Controllers\Checkout
 */
class Confirm extends Controller
{
    /**
     * @traits
     */
    use Integrator;

    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @param Request $request
     * @param string $id
     * @param TransactionRepository $transactionRepository
     *
     * @return mixed
     * @throws GuzzleException
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke(Request $request, string $id, TransactionRepository $transactionRepository)
    {
        /** @var Transaction $transaction */
        $transaction = $transactionRepository->read($id);

        // well, if still pending lets check how is it on integrator
        $status = $this->statusIntegration($transaction);
        // apply the change on transaction
        $transactionRepository->applyStatus($transaction, $status);

        $origin = $transaction->getValue('origin');
        $callback = $transaction->getValue('callback');
        $status = url("/checkout/status/{$id}");
        $suffix = "transactionId={$id}&status={$status}&origin={$origin}";
        $separator = strpos($callback, '?') === false ? '?' : '&';
        $path = $callback . $separator. $suffix;
        return redirect()->to($path);
    }
}

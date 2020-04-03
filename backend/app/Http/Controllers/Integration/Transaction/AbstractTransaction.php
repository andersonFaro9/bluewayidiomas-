<?php

namespace App\Http\Controllers\Integration\Transaction;

use App\Domains\Gateway\Shop;
use App\Domains\Gateway\Transaction\TransactionRepository;
use App\Exceptions\ErrorUserForbidden;
use App\Http\Controllers\Controller;
use App\Http\Response\AnswerTrait;
use Illuminate\Http\Request;

/**
 * Class AbstractTransaction
 * @package App\Http\Controllers\Integration\Transaction
 */
abstract class AbstractTransaction extends Controller
{
    /**
     */
    use AnswerTrait;
    /**
     * @var Request
     */
    protected $request;

    /**
     * AbstractTransaction constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @param Shop $shop
     * @param TransactionRepository $transaction
     * @param string $id
     * @return mixed
     * @throws ErrorUserForbidden
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke(Shop $shop, TransactionRepository $transaction, string $id)
    {
        $header = $this->request->header('Authorization');
        if (!$header) {
            throw new ErrorUserForbidden([]);
        }

        $authorization = base64_decode(trim(str_replace('blueway', '', $header)));
        $secrets = explode(':', $authorization);
        if (count($secrets) !== 2) {
            throw new ErrorUserForbidden([]);
        }

        /** @noinspection PhpUndefinedMethodInspection */
        $exists = $shop
            ->where('clientId', $secrets[0])
            ->where('clientSecret', $secrets[1])
            ->count();
        if (!$exists) {
            throw new ErrorUserForbidden([]);
        }

        return $this->handler($transaction, $id);
    }

    /**
     * @param TransactionRepository $repository
     * @param string $id
     * @return mixed
     */
    abstract protected function handler(TransactionRepository $repository, string $id);
}
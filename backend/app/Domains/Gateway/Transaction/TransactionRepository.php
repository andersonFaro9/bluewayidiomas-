<?php

namespace App\Domains\Gateway\Transaction;

use App\Core\AbstractModel;
use App\Core\AbstractRepository;
use App\Domains\Admin\User;
use App\Domains\Admin\User\UserRepository;
use App\Domains\Gateway\Shop;
use App\Domains\Gateway\Transaction;
use App\Exceptions\ErrorInvalidIntegration;
use App\Http\Controllers\Checkout\Integrator;
use App\Http\Controllers\Checkout\States;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Ramsey\Uuid\Uuid;

use function App\Helper\url;

/**
 * Class TransactionRepository
 *
 * @package App\Domains\Gateway\Transaction
 */
class TransactionRepository extends AbstractRepository
{
    /**
     * @traits
     */
    use Integrator;

    /**
     * The entity class name used in repository
     *
     * @var string
     */
    protected $prototype = Transaction::class;

    /**
     * @param array $data
     *
     * @return string
     * @throws Exception
     * @throws ErrorInvalidIntegration
     * @throws GuzzleException
     */
    public function create(array $data): string
    {
        $session = auth()->user();
        if (!$session) {
            return parent::create($data);
        }

        /** @var User $user */
        $user = UserRepository::instance()->read($session->uuid);
        if ($user->shop->kind === Shop::KIND_WORDPRESS) {
            return parent::create($data);
        }

        if (!isset($data['id'])) {
            $data['id'] = Uuid::uuid1()->toString();
        }
        unset($data['url']);

        /** @var AbstractModel $model */
        $model = $this->model;
        $model->fill($data);
        $model->setValue('origin', 'local');

        // the fields to send to CRYPTOS to handle DECTA
        $fields = Transaction::FIELDS_DECTA;

        $data['origin'] = $data['id'];
        $data['merchantName'] = $user->getValue('name');
        if (!$model->getValue('callback')) {
            $model->setValue('callback', url('/checkout/success'));
        }

        $onSuccess = static function ($data) use ($model) {
            $model->setValue('url', $data['url']);
            $model->setValue('integration', $data['integration']);
        };

        $this->createIntegration($user, $data, $fields, $onSuccess);

        $model->save();
        return $model->getValue('id');
    }

    /**
     * @param string $id
     * @param array $data
     *
     * @return bool
     */
    public function registerPayload(string $id, array $data): bool
    {
        $success = true;
        $transactionId = Uuid::fromString($id)->getBytes();
        foreach ($data as $property => $value) {
            $payload = [
                'transactionId' => $transactionId,
                'property' => $property,
                'value' => $value,
            ];
            /** @noinspection PhpUndefinedMethodInspection */
            if (!TransactionData::create($payload)) {
                $success = false;
            }
        }
        return $success;
    }

    /**
     * @param Transaction $transaction
     * @param array $data
     *
     * @return bool
     */
    public function approve(Transaction $transaction, array $data): bool
    {
        $transaction->setValue('status', Transaction::STATUS_APPROVED);
        if (!$transaction->save()) {
            return false;
        }
        return $this->registerPayload($transaction->getValue('id'), $data);
    }

    /**
     * @param Transaction $transaction
     * @param array $data
     *
     * @return bool
     */
    public function decline(Transaction $transaction, array $data): bool
    {
        $transaction->setValue('status', Transaction::STATUS_DECLINED);
        if (!$transaction->save()) {
            return false;
        }
        return $this->registerPayload($transaction->getValue('id'), $data);
    }

    /**
     * @param Transaction $transaction
     * @param array $data
     *
     * @return bool
     */
    public function expire(Transaction $transaction, array $data = []): bool
    {
        $transaction->setValue('status', Transaction::STATUS_EXPIRED);
        if (!$transaction->save()) {
            return false;
        }
        return $this->registerPayload($transaction->getValue('id'), $data);
    }

    /**
     * @param Transaction $transaction
     * @param string $status
     *
     * @return bool
     */
    public function applyStatus(Transaction $transaction, string $status): bool
    {
        // if is executed
        if ($status === States::STATE_EXECUTED) {
            // approve the transaction
            return $this->approve($transaction, []);
        }
        // if is canceled
        if ($status === States::STATE_CANCELED) {
            // lets decline transaction
            return $this->decline($transaction, []);
        }
        return false;
    }

    /**
     * @return array
     */
    public function getFilterable(): array
    {
        return ['id', 'customer', 'url', 'integration', 'origin', 'callback', 'status'];
    }
}

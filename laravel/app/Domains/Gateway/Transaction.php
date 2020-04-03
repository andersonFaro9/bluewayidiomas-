<?php

namespace App\Domains\Gateway;

use App\Core\AbstractModel;
use App\Domains\Admin\User;
use App\Domains\Auth\Login;
use App\Domains\Gateway\Transaction\TransactionCreated;
use App\Domains\Gateway\Transaction\TransactionCreating;
use App\Domains\Gateway\Transaction\TransactionUpdated;
use App\Exceptions\ErrorValidation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ramsey\Uuid\Uuid;

use function App\Helper\error;
use function App\Helper\is_binary;

/**
 * Class Transaction
 *
 * @property User owner
 * @package App\Domains\Gateway
 */
class Transaction extends AbstractModel
{
    /**
     * @var string
     */
    public const STATUS_PENDING = 'pending';

    /**
     * @var string
     */
    public const STATUS_APPROVED = 'approved';

    /**
     * @var string
     */
    public const STATUS_DECLINED = 'declined';

    /**
     * @var string
     */
    public const STATUS_EXPIRED = 'expired';

    /**
     * @var array
     */
    public const FIELDS_DECTA = [
        'merchantName' => ['send' => 'merchant_name', 'receive' => 'merchant_name'],
        'amount' => ['send' => 'amount', 'receive' => 'amount'],
        'customer' => ['send' => 'email', 'receive' => 'email'],
        'name' => ['send' => 'first_name', 'receive' => 'first_name'],
        'lastName' => ['send' => 'last_name', 'receive' => 'last_name'],
        'birthDate' => ['send' => 'birth_date', 'receive' => 'date_of_birth'],
        'zipCode' => ['send' => 'zip_code', 'receive' => 'zip'],
        'phone' => ['send' => 'phone', 'receive' => 'phone_number'],
        'country' => ['send' => 'country', 'receive' => 'country'],
        'state' => ['send' => 'state', 'receive' => 'state'],
        'address' => ['send' => 'address', 'receive' => 'address'],
        'city' => ['send' => 'city', 'receive' => 'city'],
    ];

    /**
     * @var array
     */
    public const FIELDS_EPG = [
        'merchantName' => ['send' => 'merchant_name', 'receive' => 'merchant_name'],
        'amount' => ['send' => 'amount', 'receive' => 'amount'],
        'customer' => ['send' => 'email', 'receive' => 'email'],
        'name' => ['send' => 'first_name', 'receive' => 'first_name'],
        'lastName' => ['send' => 'last_name', 'receive' => 'last_name'],
        'country' => ['send' => 'country', 'receive' => 'country'],
        'state' => ['send' => 'state', 'receive' => 'state'],
        'address' => ['send' => 'address', 'receive' => 'address'],
        'city' => ['send' => 'city', 'receive' => 'city'],
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer',
        'amount',
        'status',
        'url',
        'integration',
        'origin',
        'callback',
        'attempts',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'uuid',
        'counter',
    ];

    /**
     * @var array
     */
    protected $rules = [
        'customer' => ['required', 'email'],
        'amount' => ['required'],
        'status' => ['in:pending,approved,declined,expired'],
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'creating' => TransactionCreating::class,
        'created' => TransactionCreated::class,
        'updated' => TransactionUpdated::class,
    ];

    /**
     * @return void
     */
    protected static function configure(): void
    {
        $saving = function (Transaction $transaction) {
            // update the datetime of fields related to status
            $transaction->configureStatus();

            $user = $transaction->user();
            if ($user === null) {
                return;
            }

            $uuid = $user->uuid;
            if (is_binary($uuid)) {
                $uuid = self::decodeUuid($uuid);
            }
            $userId = Uuid::fromString($uuid)->getBytes();

            // set the transaction userId
            $transaction->configureUserId($userId);
            // define a URL case don't have one
            $transaction->configureURL($user);

            // validate the customer
            $transaction->validateCustomer($userId);
        };
        static::saving($saving);
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return array_merge(parent::columns(), ['userId']);
    }

    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId', 'uuid', 'owner');
    }

    /**
     * @param bool $excludeDeleted
     *
     * @return Builder
     * @noinspection ReturnTypeCanBeDeclaredInspection
     */
    public function newQuery($excludeDeleted = true)
    {
        /** @var Login $user */
        $user = auth()->user();
        /** @noinspection PhpMethodParametersCountMismatchInspection */
        $query = parent::newQuery($excludeDeleted);
        if (!$user) {
            return $query;
        }

        $userId = $user->getAttributes()['uuid'];
        return $query->where('userId', '=', $userId);
    }

    /**
     * @param string $userId
     *
     * @return void
     * @throws ErrorValidation
     */
    protected function validateCustomer(string $userId): void
    {
        if ($this->owner->shop->kind !== Shop::KIND_WORDPRESS) {
            return;
        }

        /** @noinspection PhpUndefinedMethodInspection */
        $exists = $this->where('userId', $userId)
            ->where('customer', $this->getValue('customer'))
            ->where('status', '=', static::STATUS_PENDING)
            ->count();

        if (!$exists) {
            return;
        }

        $property = 'customer';
        $message = 'duplicated';
        $value = $this->getValue('customer');
        $parameters = [];
        throw new ErrorValidation([error($property, $message, $value, $parameters)]);
    }

    /**
     * @return void
     */
    protected function configureStatus(): void
    {
        if (!$this->getValue('status')) {
            $this->setValue('status', static::STATUS_PENDING);
        }

        if ($this->getValue('status') === static::STATUS_DECLINED) {
            $this->setValue('declined', now());
        }

        if ($this->getValue('status') === static::STATUS_APPROVED) {
            $this->setValue('approved', now());
        }

        if ($this->getValue('status') === static::STATUS_EXPIRED) {
            $this->setValue('expired', now());
        }
    }

    /**
     * @param string $userId
     *
     * @return void
     */
    protected function configureUserId(string $userId): void
    {
        if ($this->getValue('userId')) {
            return;
        }
        $this->setValue('userId', $userId);
    }

    /**
     * @param User $user
     *
     * @return void
     */
    protected function configureURL($user): void
    {
        if ($this->getValue('id')) {
            return;
        }
        if ($this->getValue('url')) {
            return;
        }

        $id = $this->getFilled('id');
        $email = $this->getValue('customer');
        $amount = $this->getValue('amount');
        $name = $this->getFilled('name', '');
        $lastName = $this->getFilled('name', '');
        $returnURL = $this->getFilled('name', '');
        $query = "id={$id}&email={$email}&amount={$amount}&name={$name}&lastName={$lastName}&returnURL={$returnURL}";

        $url = "{$user->shop->url}/payment?{$query}";
        $this->setValue('url', $url);
    }

    /**
     * @return User|mixed
     */
    public function user()
    {
        if ($this->getValue('userId')) {
            return $this->owner;
        }
        /** @var User $user */
        $user = auth()->user();
        if ($user) {
            return $user;
        }
        return $this->getFilled('user');
    }
}

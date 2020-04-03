<?php

namespace App\Domains\Gateway\Transaction;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * Class TransactionData
 * @package App\Domains\Gateway\Transaction
 */
class TransactionData extends Model
{
    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    public const CREATED_AT = 'createdAt';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    public const UPDATED_AT = 'updatedAt';

    /**
     * @var string
     */
    protected $table = 'transactions_data';

    /**
     * @var array
     */
    protected $fillable = [
        'transactionId',
        'property',
        'value',
    ];

    /**
     * {@inheritDoc}
     * @noinspection StaticClosureCanBeUsedInspection
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function (TransactionData $model) {
            $uuid = Uuid::uuid1();
            /** @noinspection PhpUndefinedFieldInspection */
            $model->uuid = $uuid->getBytes();
            /** @noinspection PhpUndefinedFieldInspection */
            $model->id = $uuid->toString();
        });
    }
}
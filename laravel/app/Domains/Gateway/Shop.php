<?php

namespace App\Domains\Gateway;

use App\Core\AbstractModel;

/**
 * Class Shop
 *
 * @property string url
 * @property string kind
 * @package App\Domains\Gateway
 */
class Shop extends AbstractModel
{
    /**
     * @var string
     */
    public const KIND_WORDPRESS = 'WORDPRESS';

    /**
     * @var string
     */
    public const KIND_EASY_PAYMENT_GATEWAY = 'SENNA';

    /**
     * @var string
     */
    public const KIND_DECTA = 'DECTA';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shops';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'url',
        'clientId',
        'clientSecret',
        'kind',
    ];

    /**
     * @var array
     */
    protected $rules = [
        'name' => ['required'],
        'url' => ['required'],
        'clientId' => ['required'],
        'clientSecret' => ['required'],
        'kind' => ['regex:(WORDPRESS|SENNA|DECTA)'],
    ];

    /**
     * @var array
     */
    protected $uniques = [
        'clientSecret',
        'clientId',
    ];
}

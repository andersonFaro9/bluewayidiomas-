<?php

namespace App\Domains\Admin;

use App\Domains\Admin\PasswordReset\PasswordResetCreated;
use App\Domains\Util\Instance;
use DeviTools\Persistence\AbstractModel;

/**
 * Class PasswordReset
 * @property string email
 * @property string token
 * @property string reset_link
 * @package App\Domains\Admin
 */
class PasswordReset extends AbstractModel
{
    /**
     * @trait
     */
    use Instance;

    /**
     * Hack to ignore updated_at
     */
    const UPDATED_AT = 'createdAt';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'token',
        'credential',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => PasswordResetCreated::class,
    ];
}

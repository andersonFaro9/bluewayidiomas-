<?php

namespace App\Domains\Admin;

use App\Core\AbstractModel;
use App\Domains\Admin\User\UserCreated;
use App\Domains\Admin\User\UserCreating;
use App\Domains\Admin\User\UserUpdating;
use App\Domains\Gateway\Shop;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class User
 *
 * @property mixed uuid
 * @property string name
 * @property string email
 * @property string firstName
 * @property string lastName
 * @property string birthday
 * @property string gender
 * @property string password
 * @property string remember_token
 * @property bool active
 * @property string activation_link
 * @package App\Domains\Admin
 */
class User extends AbstractModel
{
    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'profileId',
        'password',
        'active',
    ];

    /**
     * @var array
     */
    protected $rules = [
        'profileId' => 'required',
        'name' => 'required',
        'email' => ['required', 'email'],
        'password' => ['sometimes', 'required', 'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[#$^+=!*()@%&]?).{6,}$/'],
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'uuid',
        'password',
        'remember_token',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'creating' => UserCreating::class,
        'created' => UserCreated::class,
        'updating' => UserUpdating::class,
    ];

    /**
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $uniques = [
        'email',
    ];

    /**
     * Get the primary key for the model.
     *
     * @return string
     */
    public function getAuthIdentifier(): string
    {
        return 'id';
    }

    /**
     * @return array
     */
    public function manyToOne(): array
    {
        return ['profile' => 'profileId'];
    }

    /**
     * @return BelongsTo
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'profileId', 'uuid', 'profile');
    }

    /**
     * @return string
     */
    public function prefix(): string
    {
        return 'admin.user';
    }
}

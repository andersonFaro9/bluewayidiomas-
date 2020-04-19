<?php

declare(strict_types=1);

namespace App\Domains\Auth;

use App\Domains\Admin\Profile;
use Dyrynda\Database\Support\GeneratesUuid as HasBinaryUuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User
 *
 * @package App\Domains\Admin
 * @property string uuid
 * @property string password
 * @property boolean active
 * @property string birthday
 * @property Profile profile
 * @method static Login where(string $column, mixed $value)
 * @method static Login whereRaw(string $column, mixed $value)
 * @method Login firstOrFail()
 * @method Login first()
 */
class Login extends Authenticatable implements JWTSubject
{
    /**
     * @see Notifiable
     */
    use Notifiable;

    /**
     * @see HasBinaryUuid
     */
    use HasBinaryUuid;

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @var array
     */
    protected $casts = ['uuid' => 'uuid'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'uuid',
        'password',
        'profileId',
        'remember_token',
    ];

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'binary';

    /**
     * @return BelongsTo
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'profileId', 'uuid');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get the primary key for the model.
     *
     * @return string
     */
    public function getKeyName()
    {
        return 'id';
    }
}

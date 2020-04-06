<?php

namespace App\Domains\Auth;

use DateTime;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use JsonSerializable;
use Dyrynda\Database\Support\GeneratesUuid as HasBinaryUuid;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User
 * @package App\Domains\Admin
 * @property string password
 * @property boolean active
 * @property string birthday
 * @method static Login where(string $column, mixed $value)
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
        'remember_token',
    ];

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'binary';

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

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize ()
    {
        return parent::jsonSerialize();
    }
}

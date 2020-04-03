<?php

namespace App\Domains\Auth;

use App\Domains\Util\Instance;
use App\Exceptions\ErrorUserInative;
use App\Exceptions\ErrorUserUnauthorized;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use function App\Helper\uuid;

/**
 * Class Session
 * @package App\Domains\Auth
 */
class Session extends Login
{
    /**
     * @trait
     */
    use Instance;

    /**
     * @param string $email
     * @param string $password
     * @param string $device
     * @return array
     * @throws ErrorUserInative
     * @throws ErrorUserUnauthorized
     */
    public function login(string $email, string $password, string $device = '')
    {
        /** @var Eloquent $login */
        $login = static::where('email', $email)->first();

        if ($login === null) {
            throw new ErrorUserUnauthorized(['credentials' => 'unknown']);
        }

        if (!Hash::check($password, $login->getAttribute('password'))) {
            throw new ErrorUserUnauthorized(['credentials' => 'invalid']);
        }

        if (!$login->getAttribute('active')) {
            throw new ErrorUserInative(['user' => 'inactive']);
        }

        return static::credentials($login, $device);
    }

    /**
     * @param Eloquent $user
     * @param string $device
     * @return array
     * @throws ErrorUserUnauthorized
     */
    public static function credentials(Eloquent $user, string $device)
    {
        $session = uuid();
        $id = $user->getAttribute('id');

        Cache::forever($session, ['id' => $id, 'device' => $device]);

        $customClaims = [
            'session' => $session
        ];
        /** @noinspection PhpUndefinedMethodInspection */
        $token = JWTAuth::claims($customClaims)->fromUser($user);

        if (!$token) {
            throw new ErrorUserUnauthorized(['credentials' => 'invalid']);
        }

        /** @noinspection PhpUndefinedMethodInspection */
        $token_expires_at = JWTAuth::setToken($token)->getPayload()->get('exp');

        return [
            'token' => $token,
            'token_type' => 'bearer',
            'token_expires_at' => $token_expires_at,
            'session' => $session,
        ];
    }

    /**
     * @param Eloquent $user
     * @return array
     */
    public static function payload(Eloquent $user)
    {
        return [
            'id' => $user->getAttribute('id'),
            'email' => $user->getAttribute('email'),
            'firstName' => $user->getAttribute('firstName'),
            'lastName' => $user->getAttribute('lastName'),
            'name' => $user->getAttribute('name'),
            'photo' => $user->getAttribute('photo'),
        ];
    }
}

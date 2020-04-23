<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Domains\Auth\Session;
use App\Exceptions\ErrorUserInative;
use App\Exceptions\ErrorUserLocked;
use App\Exceptions\ErrorUserUnauthorized;
use App\Http\Controllers\Api\AbstractController;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class Login
 *
 * @package App\Http\Controllers\Api\Auth
 */
class Login extends AbstractController
{
    /**
     * @see ThrottlesLogins
     */
    use ThrottlesLogins;

    /**
     * @param Request $request
     * @param Session $session
     *
     * @return JsonResponse
     * @throws ErrorUserInative
     * @throws ErrorUserLocked
     * @throws ErrorUserUnauthorized
     */
    public function __invoke(Request $request, Session $session)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            throw new ErrorUserLocked(['user' => 'locked']);
        }

        $login = $request->post('login');
        $password = $request->post('password');

        if (!$login || !$password) {
            return $this->answerFail(['user' => 'required', 'password' => 'required']);
        }
        $device = $request->header('device');

        try {
            $data = $session->login($login, $password, $device);
            return $this->answerSuccess($data);
        } catch (ErrorUserUnauthorized | ErrorUserInative $errorUserUnauthorized) {
            $this->incrementLoginAttempts($request);
            throw $errorUserUnauthorized;
        }
    }

    /**
     * @return string
     */
    public function username()
    {
        return 'username';
    }
}

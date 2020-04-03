<?php
/**
 *
 */

namespace App\Http\Controllers\Api\Auth;

use App\Domains\Auth\Login;
use App\Domains\Auth\Session as Auth;
use App\Exceptions\ErrorUserUnauthorized;
use App\Exceptions\ErrorValidation;
use App\Http\Controllers\Api\AbstractAnswerController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use function PhpBrasil\Collection\Helper\prop;

/**
 * Class Session
 * @package App\Http\Controllers\Api\Auth
 */
class Session extends AbstractAnswerController
{
    /**
     * Refresh a token.
     *
     * @param Request $request
     * @param string $session
     * @return JsonResponse
     * @throws ErrorUserUnauthorized
     * @throws ErrorValidation
     */
    public function __invoke(Request $request, string $session)
    {
        if (!$session) {
            throw new ErrorValidation(['session' => 'required']);
        }
        if (!Cache::has($session)) {
            return $this->answerFail(['session' => $session]);
        }
        $payload = Cache::get($session);

        /** @noinspection PhpUndefinedMethodInspection */
        $user = Login::find(prop($payload, 'id'));
        if (!$user) {
            throw new ErrorValidation(['user' => 'required']);
        }
        if (prop($payload, 'device') !== $request->header('device')) {
            return $this->answerFail(['session' => 'invalid']);
        }

        if (env('APP_AUTH_SESSION') === 'forget') {
            Cache::forget($session);
        }

        return $this->answerSuccess(Auth::credentials($user, $session));
    }
}

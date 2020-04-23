<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\AbstractController;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class Refresh
 *
 * @package App\Http\Controllers\Api\Auth
 */
class Refresh extends AbstractController
{
    /**
     * Refresh a token.
     *
     * @return JsonResponse
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     */
    public function __invoke()
    {
        $auth = auth();

        $token = $auth->refresh();

        $payload = $auth->payload();

        /** @noinspection PhpUndefinedMethodInspection */
        $token_expires_at = JWTAuth::setToken($token)->getPayload()->get('exp');

        return $this->answerSuccess([
            'token' => $token,
            'token_type' => 'bearer',
            'token_expires_at' => $token_expires_at,
            'session' => $payload->get('session'),
        ]);
    }
}

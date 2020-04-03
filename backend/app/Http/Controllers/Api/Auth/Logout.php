<?php

namespace App\Http\Controllers\Api\Auth;

use App\Exceptions\ErrorValidation;
use App\Http\Controllers\Api\AbstractAnswerController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class Logout
 * @package App\Http\Controllers\Api\Auth
 */
class Logout extends AbstractAnswerController
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ErrorValidation
     */
    public function __invoke(Request $request)
    {
        $auth = auth();
        if ($auth->guest()) {
            throw new ErrorValidation(['session' => 'required']);
        }

        // $user = $auth->user();
        // $auth->logout();
        /** @noinspection PhpUndefinedMethodInspection */
        $payload = $auth->payload();

        /** @noinspection PhpUndefinedMethodInspection */
        return $this->answerSuccess([
            'session' => $payload->get('session'),
        ]);
    }
}

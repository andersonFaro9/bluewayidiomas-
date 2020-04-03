<?php

namespace App\Http\Controllers\Api\Auth;

use App\Domains\Admin\User\UserRepository;
use App\Exceptions\ErrorInvalidArgument;
use App\Exceptions\ErrorValidation;
use App\Http\Controllers\Api\AbstractAnswerController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class Remember
 * @package App\Http\Controllers\Api\Auth
 */
class Remember extends AbstractAnswerController
{
    /**
     * Refresh a token.
     *
     * @param Request $request
     * @param UserRepository $userRepository
     * @return JsonResponse
     * @throws ErrorValidation
     * @throws ErrorInvalidArgument
     */
    public function __invoke(Request $request, UserRepository $userRepository)
    {
        // extract login from request
        $login = $request->get('login');
        if (!$login) {
            throw new ErrorValidation(['login' => 'required']);
        }

        // search user by email
        $user = $userRepository->findByEmail($login);
        if (!$user) {
            throw new ErrorValidation(['login' => 'undefined']);
        }

        // create password reset request
        $success = $userRepository->createResetPassword($login);
        if ($success) {
            return $this->answerSuccess($login);
        }

        // if something goes wrong...
        return $this->answerError("Can't reset the password of '{$login}'");
    }
}

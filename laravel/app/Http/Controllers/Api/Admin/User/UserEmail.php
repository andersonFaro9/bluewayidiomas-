<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Exceptions\ErrorResourceIsGone;
use App\Http\Controllers\Api\Admin\UserController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class UserEmail
 * @package App\Http\Controllers\Api\Admin
 */
class UserEmail extends UserController
{
    /**
     * @param Request $request
     * @param string $email
     * @return JsonResponse
     * @throws ErrorResourceIsGone
     */
    public function __invoke(Request $request, string $email): JsonResponse
    {
        $read = $this->repository->read(['email' => $email]);
        if (!$read) {
            throw new ErrorResourceIsGone(['email' => $email]);
        }
        $user = $read->first();
        if (!$user) {
            throw new ErrorResourceIsGone(['email' => $email]);
        }
        return $this->answerSuccess($user);
    }
}

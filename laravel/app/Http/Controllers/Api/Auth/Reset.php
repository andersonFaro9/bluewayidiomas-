<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Domains\Admin\User\UserRepository;
use App\Exceptions\ErrorValidation;
use App\Http\Controllers\Api\AbstractController;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Class Reset
 *
 * @package App\Http\Controllers\Api\Auth
 */
class Reset extends AbstractController
{
    /**
     * Refresh a token.
     *
     * @param string $code
     *
     * @return JsonResponse
     * @throws ErrorValidation
     * @throws Exception
     */
    public function __invoke($code)
    {
        // generate an error if the code is empty
        if (empty($code)) {
            throw new ErrorValidation(['code' => 'required']);
        }

        // get the reset password record
        $resetPassword = UserRepository::instance()->getResetPassword($code);
        if (!$resetPassword) {
            throw new ErrorValidation(['code' => 'invalid']);
        }

        // return the email of user associated to reset password request
        return $this->answerSuccess(['email' => $resetPassword->getValue('email')]);
    }
}

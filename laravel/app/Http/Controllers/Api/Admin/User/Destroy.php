<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Domains\Admin\User;
use App\Domains\Admin\User\UserRepository;
use App\Exceptions\ErrorResourceIsGone;
use App\Exceptions\ErrorRuntime;
use App\Exceptions\ErrorUserForbidden;
use App\Http\Controllers\Controller;
use App\Http\Response\AnswerTrait;
use App\Http\Status;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class Destroy
 * @package App\Http\Controllers\Api\Admin
 */
class Destroy extends Controller
{
    use AnswerTrait;

    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @param Request $request
     * @return mixed
     * @throws ErrorResourceIsGone
     * @throws ErrorRuntime
     * @throws ErrorUserForbidden
     * @throws Exception
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke(Request $request)
    {
        $login = auth()->user();
        if (!$login) {
            throw new ErrorUserForbidden(['credentials' => 'unknown']);
        }

        /** @var User $user */
        $user = UserRepository::instance()->findById($login->id);
        if (!$user) {
            throw new ErrorResourceIsGone(['credentials' => 'unknown']);
        }

        $password = $request->post('password');
        if (!Hash::check($password, $user->getValue('password'))) {
            throw new ErrorUserForbidden(['password' => 'invalid']);
        }

        /*
        $user->setValue('email', "rip[" . now() . "][{$user->getValue('email')}]");
        $user->setValue('active', false);
        if (!$user->save()) {
            throw new ErrorRuntime(['user' => 'save']);
        }
        */

        $deleted = $user->forceDelete();
        if ($deleted) {
            return $this->answerSuccess([], [], Status::CODE_204);
        }

        throw new ErrorRuntime(['error' => 'unknown']);
    }
}

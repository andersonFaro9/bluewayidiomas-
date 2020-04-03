<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Domains\Admin\User\UserRepository;
use App\Exceptions\ErrorResourceIsGone;
use App\Exceptions\ErrorRuntime;
use App\Exceptions\ErrorUserForbidden;
use App\Http\Controllers\Controller;
use App\Http\Response\AnswerTrait;
use App\Http\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class Password
 * @package App\Http\Controllers\Api\Admin
 */
class Password extends Controller
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
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke(Request $request)
    {
        $login = auth()->user();
        if (!$login) {
            throw new ErrorUserForbidden(['credentials' => 'unknown']);
        }

        $user = UserRepository::instance()->findById($login->id);
        if (!$user) {
            throw new ErrorResourceIsGone(['credentials' => 'unknown']);
        }

        $current = $request->post('current');
        if (!Hash::check($current, $user->getValue('password'))) {
            throw new ErrorUserForbidden(['password' => 'invalid']);
        }

        $password = $request->post('password');
        $confirm = $request->post('confirm');
        if ($password !== $confirm) {
            return $this->answerFail(['confirm' => ['sameAs' => 'password']]);
        }

        $user->setValue('password', $password);
        $save = $user->save();
        if ($save) {
            return $this->answerSuccess([], [], Status::CODE_204);
        }

        throw new ErrorRuntime(['error' => 'unknown']);
    }
}

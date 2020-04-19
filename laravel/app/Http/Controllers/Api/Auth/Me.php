<?php

namespace App\Http\Controllers\Api\Auth;

use App\Domains\Admin\Action\ActionRepository;
use App\Domains\Auth\Login;
use App\Exceptions\ErrorValidation;
use App\Http\Controllers\Api\AbstractAnswerController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class Me
 *
 * @package App\Http\Controllers\Api\Auth
 */
class Me extends AbstractAnswerController
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     * @throws ErrorValidation
     */
    public function __invoke(Request $request)
    {
        $auth = auth();
        if ($auth->guest()) {
            throw new ErrorValidation(['session' => 'required']);
        }

        $user = $auth->user();
        if (!($user instanceof Login)) {
            throw new ErrorValidation(['user' => 'required']);
        }

        $data = $user->getAttributes();
        $data['actions'] = ActionRepository::instance()->actions($data['profileId']);
        $data['profile'] = $user->profile->reference;

        unset($data['uuid'], $data['profileId'], $data['password']);

        return $this->answerSuccess($data);
    }
}

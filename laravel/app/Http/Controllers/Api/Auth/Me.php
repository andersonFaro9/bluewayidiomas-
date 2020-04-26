<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Domains\Admin\Action\ActionRepository;
use App\Domains\Auth\Login;
use DeviTools\Exceptions\ErrorValidation;
use DeviTools\Http\AbstractController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class Me
 *
 * @package App\Http\Controllers\Api\Auth
 */
class Me extends AbstractController
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

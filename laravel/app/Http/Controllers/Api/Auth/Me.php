<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Domains\Academic\Registration\RegistrationRepository;
use App\Domains\Admin\Action\ActionRepository;
use App\Domains\Admin\Profile;
use App\Domains\Auth\Login;
use DeviTools\Exceptions\ErrorValidation;
use DeviTools\Http\AbstractController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

/**
 * Class Me
 *
 * @package App\Http\Controllers\Api\Auth
 */
class Me extends AbstractController
{
    /**
     * @param Request $request
     * @param ActionRepository $actionRepository
     * @param RegistrationRepository $registrationRepository
     *
     * @return JsonResponse
     * @throws ErrorValidation
     */
    public function __invoke(
        Request $request,
        ActionRepository $actionRepository,
        RegistrationRepository $registrationRepository
    ) {
        $auth = auth();
        if ($auth->guest()) {
            throw new ErrorValidation(['session' => 'required']);
        }

        $user = $auth->user();
        if (!($user instanceof Login)) {
            throw new ErrorValidation(['user' => 'required']);
        }

        $data = $user->getAttributes();
        $data['actions'] = $actionRepository->actions($data['profileId']);
        $data['profile'] = $user->profile->reference;

        if ($user->profile->reference === Profile::REFERENCE_STUDENT) {
            $data['info'] = $registrationRepository->getInfo($data['uuid']);
        }

        unset($data['uuid'], $data['profileId'], $data['password']);

        return $this->answerSuccess($data);
    }
}

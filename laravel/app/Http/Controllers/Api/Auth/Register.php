<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Domains\Admin\Profile;
use App\Domains\Admin\Profile\ProfileRepository;
use App\Domains\Admin\User;
use App\Domains\Admin\User\UserRepository;
use App\Exceptions\ErrorRuntime;
use App\Http\Controllers\Api\AbstractController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Php\Text;

/**
 * Class Register
 *
 * @package App\Http\Controllers\Api\Auth
 */
class Register extends AbstractController
{
    /**
     * Create a new user
     *
     * @param Request $request
     * @param UserRepository $userRepository
     * @param ProfileRepository $profileRepository
     *
     * @return JsonResponse
     * @throws ErrorRuntime
     */
    public function __invoke(Request $request, UserRepository $userRepository, ProfileRepository $profileRepository)
    {
        $username = $request->post('username');
        $data = [
            'profileId' => $profileRepository->getProfileByReference(Profile::REFERENCE_STUDENT)->uuid,
            'username' => $username,
            'name' => Text::capitalize($username),
            'active' => true,
        ];

        $id = $userRepository->create($data);

        /** @var User $user */
        $user = $userRepository->findById($id);

        // if $user something is wrong
        if (!$user) {
            throw new ErrorRuntime(['error' => 'Error on register user']);
        }

        return $this->answerSuccess($user);
    }
}

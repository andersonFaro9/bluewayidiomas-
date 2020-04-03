<?php

namespace App\Http\Controllers\Api\Auth;

use App\Domains\Admin\User;
use App\Domains\Admin\User\UserRepository;
use App\Domains\Auth\Session;
use App\Exceptions\ErrorRuntime;
use App\Exceptions\ErrorUserInative;
use App\Exceptions\ErrorUserUnauthorized;
use App\Http\Controllers\Api\AbstractAnswerController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class Register
 * @package App\Http\Controllers\Api\Auth
 */
class Register extends AbstractAnswerController
{
    /**
     * Create a new user
     *
     * @param Request $request
     * @param UserRepository $userRepository
     * @return JsonResponse
     * @throws ErrorRuntime
     * @throws ErrorUserInative
     * @throws ErrorUserUnauthorized
     */
    public function __invoke(Request $request, UserRepository $userRepository)
    {
        // extract query from request and put it in state manager
        UserRepository::state($request->post('query'));

        // create the payload to regular register
        $input = [
            'email' => $request->post('email'),
            'firstName' => $request->post('firstName'),
            'lastName' => $request->post('lastName'),
            'birthday' => $request->post('birthday'),
            'gender' => $request->post('gender'),
        ];

        if (env('APP_AUTH_REGISTER') === 'simple') {
            // create the payload to simple register
            $input = [
                'firstName' => $request->post('firstName'),
                'lastName' => $request->post('lastName'),
                'email' => $request->post('email'),
                'password' => $request->post('password'),
                'confirm' => $request->post('confirm'),
            ];
        }

        // create the new User
        $id = $userRepository->create($input);

        /** @var User $user */
        $user = $userRepository->findById($id);

        // if $user something is wrong
        if (!$user) {
            throw new ErrorRuntime(['error' => "Error on register user"]);
        }

        $data = [];
        // if the register is simple
        if (env('APP_AUTH_REGISTER') === 'simple') {
            // extract email, password and device from request
            $email = $request->post('email');
            $password = $request->post('password');
            $device = $request->header('device');

            // then generate the login answer
            $data = Session::instance()->login($email, $password, $device);
        }

        return $this->answerSuccess($data);
    }
}

<?php

namespace App\Domains\Admin\PasswordReset;

use App\Domains\Admin\PasswordReset;
use App\Domains\Admin\User;
use App\Domains\Admin\User\UserRepository;
use App\Units\Mail\Sender;
use Illuminate\Support\Facades\Lang;

/**
 * Class PasswordResetCreated
 * @package App\Domains\Admin\User
 */
class PasswordResetCreated
{
    /**
     * UserBefore constructor.
     * @param PasswordReset $passwordReset
     */
    public function __construct(PasswordReset $passwordReset)
    {
        $passwordReset->reset_link = env('APP_CLIENT') . "/auth/reset/{$passwordReset->token}";

        $subject = Lang::trans('admin/user/reset.message.subject');

        /** @var User $user */
        $user = UserRepository::instance()->findByEmail($passwordReset->email);

        $parameters = [
            'template' => 'admin.user.reset',
            'data' => (object)[
                'name' => $user->getValue('name'),
                'email' => $passwordReset->email,
                'reset_link' => $passwordReset->reset_link,
            ],
        ];

        Sender::instance($parameters)
            ->subject($subject)
            ->dispatch($passwordReset->email);
    }
}

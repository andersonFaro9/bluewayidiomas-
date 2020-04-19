<?php

declare(strict_types=1);

namespace App\Domains\Admin\User;

use App\Domains\Admin\User;
use App\Units\Mail\Sender;
use Illuminate\Support\Facades\Lang;

/**
 * Class UserCreated
 * @package App\Domains\Admin\User
 */
class UserCreated
{
    /**
     * UserCreated constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        // $this->sendCreationEmail($user);
    }

    /**
     * @param User $user
     * @return void
     */
    private function sendCreationEmail(User $user): void
    {
        $user->activation_link = env('APP_CLIENT') . "/auth/confirm/{$user->remember_token}";

        $subject = Lang::trans('admin/user/created.message.subject');
        $action = Lang::trans('admin/user/created.message.action');

        $parameters = [
            'template' => 'admin.user.created',
            'data' => (object)[
                'email' => $user->email,
                'name' => $user->name,
                'activation_link' => $user->activation_link,
                'subject' => $subject,
                'action' => $action,
            ],
        ];

        Sender::instance($parameters)
            ->subject($subject)
            ->dispatch($user->email);
    }
}

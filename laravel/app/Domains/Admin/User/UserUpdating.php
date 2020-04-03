<?php

namespace App\Domains\Admin\User;

use App\Domains\Admin\User;

/**
 * Class UserUpdating
 * @package App\Domains\Admin\User
 */
class UserUpdating extends UserBefore
{
    /**
     * UserBefore constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}

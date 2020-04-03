<?php

namespace App\Domains\Admin\User;

use App\Domains\Admin\User;
use Exception;
use Ramsey\Uuid\Uuid;

/**
 * Class UserCreating
 * @package App\Domains\Admin\User
 */
class UserCreating extends UserBefore
{
    /**
     * UserBefore constructor.
     *
     * @param User $user
     *
     * @throws Exception
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}
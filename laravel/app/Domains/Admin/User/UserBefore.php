<?php

namespace App\Domains\Admin\User;

use App\Domains\Admin\Profile;
use App\Domains\Admin\User;
use Illuminate\Support\Facades\Hash;

use function PhpBrasil\Collection\Helper\prop;

/**
 * Class UserBefore
 * @package App\Domains\Admin\User
 */
class UserBefore
{
    /**
     * UserBefore constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->configurePassword($user);
    }

    /**
     * @param User $user
     */
    private function configurePassword(User $user): void
    {
        if (!$user->password) {
            return;
        }
        $info = Hash::info($user->password);
        if (prop($info, 'algoName') !== 'unknown') {
            return;
        }
        $user->password = Hash::make($user->password);
    }
}

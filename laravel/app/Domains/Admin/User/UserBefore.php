<?php

declare(strict_types=1);

namespace App\Domains\Admin\User;

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
        $password = $user->getValue('password');
        if (!$password) {
            $password = uniqid('Ab1#', true);
        }

        $info = Hash::info($password);
        if (prop($info, 'algoName') !== 'unknown') {
            return;
        }
        $user->setValue('password', Hash::make($password));
    }
}

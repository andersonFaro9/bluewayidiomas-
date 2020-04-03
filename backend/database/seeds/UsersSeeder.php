<?php

use App\Domains\Admin\User\UserRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class UsersSeeder
 */
class UsersSeeder extends Seeder
{
    /**
     * @throws Exception
     */
    public function run()
    {
        // use Illuminate\Support\Facades\DB;
        // DB::table('users')->delete();
        UserRepository::instance()->create(
            [
                'name' => 'William Correa',
                'email' => 'admin@blueway.com',
                'password' => 'aq1sw2de3',
                'active' => true,
            ]
        );
    }
}

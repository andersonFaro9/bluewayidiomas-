<?php

use App\Domains\Admin\Action\ActionRepository;
use App\Domains\Admin\Profile;
use App\Domains\Admin\Profile\ProfileRepository;
use App\Domains\Admin\User\UserRepository;
use App\Domains\Util\Instance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     */
    use Instance;

    /**
     * Seed the application's database.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('profile_action')->delete();
        DB::table('profiles')->delete();
        DB::table('actions')->delete();

        $home = ActionRepository::instance()->create(
            [
                'actionId' => null,
                'name' => 'Início',
                'namespace' => 'home',
                'path' => '/dashboard/home',
                'separated' => false,
                'assortment' => 1,
            ]
        );

        $academic = ActionRepository::instance()->create(
            [
                'actionId' => null,
                'name' => 'Acadêmico',
                'namespace' => 'academic',
                'path' => '',
                'separated' => false,
                'assortment' => 2,
            ]
        );

        $grade = ActionRepository::instance()->create(
            [
                'actionId' => Uuid::fromString($academic)->getBytes(),
                'name' => 'Cursos',
                'namespace' => 'academic.grade',
                'path' => '/dashboard/academic/grade',
                'separated' => true,
                'assortment' => 1,
            ]
        );

        $registration = ActionRepository::instance()->create(
            [
                'actionId' => Uuid::fromString($academic)->getBytes(),
                'name' => 'Cursos',
                'namespace' => 'academic.registration',
                'path' => '/dashboard/academic/registration',
                'separated' => true,
                'assortment' => 2,
            ]
        );

        $activity = ActionRepository::instance()->create(
            [
                'actionId' => Uuid::fromString($academic)->getBytes(),
                'name' => 'Atividades',
                'namespace' => 'academic.activity',
                'path' => '/dashboard/academic/activity',
                'separated' => false,
                'assortment' => 3,
            ]
        );

        $admin = ActionRepository::instance()->create(
            [
                'actionId' => null,
                'name' => 'Administração',
                'namespace' => 'admin',
                'path' => '',
                'separated' => false,
                'assortment' => 3,
            ]
        );

        $user = ActionRepository::instance()->create(
            [
                'actionId' => Uuid::fromString($admin)->getBytes(),
                'name' => 'Usuários',
                'namespace' => 'admin.user',
                'path' => '/dashboard/admin/user',
                'separated' => true,
                'assortment' => 1,
            ]
        );

        $profile = ActionRepository::instance()->create(
            [
                'actionId' => Uuid::fromString($admin)->getBytes(),
                'name' => 'Perfis',
                'namespace' => 'admin.profile',
                'path' => '/dashboard/admin/profile',
                'separated' => false,
                'assortment' => 2,
            ]
        );

        $action = ActionRepository::instance()->create(
            [
                'actionId' => Uuid::fromString($admin)->getBytes(),
                'name' => 'Ações',
                'namespace' => 'admin.action',
                'path' => '/dashboard/admin/action',
                'separated' => false,
                'assortment' => 3,
            ]
        );

        $adminProfileId = ProfileRepository::instance()->create(
            [
                'name' => 'GESTOR',
                'reference' => Profile::REFERENCE_ADMIN,
                'actions' => [
                    ['id' => $home],
                    ['id' => $academic],
                    ['id' => $grade],
                    ['id' => $registration],
                    ['id' => $activity],
                    ['id' => $admin],
                    ['id' => $user],
                    ['id' => $profile],
                    ['id' => $action],
                ]
            ]
        );

        UserRepository::instance()->create(
            [
                'profileId' => Uuid::fromString($adminProfileId)->getBytes(),
                'name' => 'Blue Way',
                'email' => 'admin@blueway.com',
                'password' => 'aq1sw2de3',
                'active' => true,
            ]
        );

        $teacherProfileId = ProfileRepository::instance()->create(
            [
                'name' => 'PROFESSOR',
                'reference' => Profile::REFERENCE_TEACHER,
                'actions' => [
                    ['id' => $home],
                    ['id' => $academic],
                    ['id' => $registration],
                    ['id' => $activity],
                ]
            ]
        );

        UserRepository::instance()->create(
            [
                'profileId' => Uuid::fromString($teacherProfileId)->getBytes(),
                // 'id' => '15d2a4f0-762a-11ea-b897-0242ac120005',
                'name' => 'Teacher Blue Way',
                'email' => 'teacher@blueway.com',
                'password' => 'aq1sw2de3',
                'active' => true,
            ]
        );
    }
}

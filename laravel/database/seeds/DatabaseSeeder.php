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
                'icon' => 'home',
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
                'icon' => 'school',
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
                'icon' => 'folder',
                'namespace' => 'academic.grade',
                'path' => '/dashboard/academic/grade',
                'separated' => true,
                'assortment' => 1,
            ]
        );

        $registration = ActionRepository::instance()->create(
            [
                'actionId' => Uuid::fromString($academic)->getBytes(),
                'name' => 'Matrículas',
                'icon' => 'folder_shared',
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
                'icon' => 'description',
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
                'icon' => 'settings',
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
                'icon' => 'people',
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
                'icon' => 'widgets',
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
                'icon' => 'account_tree',
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
                'name' => 'ADMINISTRADOR',
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
                'name' => 'PROFESSOR',
                'email' => 'teacher@blueway.com',
                'password' => 'aq1sw2de3',
                'active' => true,
            ]
        );

        $studentProfileId = ProfileRepository::instance()->create(
            [
                'name' => 'ALUNO',
                'reference' => Profile::REFERENCE_STUDENT,
                'actions' => [
                    ['id' => $home],
                    ['id' => $academic],
                    ['id' => $activity],
                ]
            ]
        );

        UserRepository::instance()->create(
            [
                'profileId' => Uuid::fromString($studentProfileId)->getBytes(),
                'name' => 'ALUNO',
                'email' => 'student@blueway.com',
                'password' => 'aq1sw2de3',
                'active' => true,
            ]
        );
    }
}

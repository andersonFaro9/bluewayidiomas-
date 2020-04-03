<?php

namespace App\Domains\Admin\User;

use App\Core\AbstractModel;
use App\Core\AbstractRepository;
use App\Domains\Admin\PasswordReset;
use App\Domains\Admin\Profile;
use App\Domains\Admin\User;
use DateTime;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

use function App\Helper\uuid;

/**
 * Class UserRepository
 *
 * @package App\Domains\Admin\User
 * @method findByEmail(string $email)
 */
class UserRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected $prototype = User::class;

    /**
     * @return Collection
     */
    public function getAdmins(): Collection
    {
        return $this->model::whereHas(
            'profile',
            static function (Builder $query) {
                $query->where('reference', '=', Profile::REFERENCE_ADMIN);
            }
        )->get();
    }

    /**
     * @return array
     */
    public function getFilterable(): array
    {
       return ['name', 'email'];
    }
}

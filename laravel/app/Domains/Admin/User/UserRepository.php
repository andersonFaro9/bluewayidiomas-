<?php

declare(strict_types=1);

namespace App\Domains\Admin\User;

use App\Domains\Admin\Profile;
use App\Domains\Admin\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use DeviTools\Persistence\AbstractRepository;

/**
 * Class UserRepository
 *
 * @package App\Domains\Admin\User
 */
class UserRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected string $prototype = User::class;

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

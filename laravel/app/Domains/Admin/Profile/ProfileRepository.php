<?php

namespace App\Domains\Admin\Profile;

use App\Core\AbstractRepository as Repository;
use App\Domains\Admin\Profile;

/**
 * Class ProfileRepository
 * @package App\Domains\Admin\Profile
 */
class ProfileRepository extends Repository
{
    /**
     * The entity class name used in repository
     *
     * @var string
     */
    protected $prototype = Profile::class;

    /**
     * @return array
     */
    public function getFilterable(): array
    {
        return ['name', 'reference'];
    }
}
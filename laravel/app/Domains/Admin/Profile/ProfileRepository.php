<?php

declare(strict_types=1);

namespace App\Domains\Admin\Profile;

use App\Domains\Admin\Profile;
use DeviTools\Persistence\AbstractRepository as Repository;

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
    protected string $prototype = Profile::class;

    /**
     * @return array
     */
    public function getFilterable(): array
    {
        return ['name', 'reference'];
    }

    /**
     * @param string $reference
     *
     * @return mixed
     */
    public function getProfileByReference(string $reference)
    {
        return $this->model->where('reference', $reference)->first();
    }
}

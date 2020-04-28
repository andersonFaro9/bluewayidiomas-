<?php

namespace App\Domains\Academic\Activity;

use App\Domains\Academic\Activity;
use DeviTools\Persistence\AbstractRepository;

/**
 * Class ActivityRepository
 *
 * @package App\Domains\Academic\Activity
 */
class ActivityRepository extends AbstractRepository
{
    /**
     * The entity class name used in repository
     *
     * @var string
     */
    protected string $prototype = Activity::class;

    /**
     * @return array
     */
    public function getFilterable(): array
    {
        return [
            'type',
            'documentType',
            'linkType',
            'name',
            'description',
            'document',
            'link',
        ];
    }
}

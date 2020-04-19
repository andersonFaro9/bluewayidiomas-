<?php

namespace App\Domains\Academic\Activity;

use App\Core\AbstractRepository;
use App\Domains\Academic\Activity;

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
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Academic;

use App\Domains\Academic\Activity\ActivityRepository;
use Illuminate\Http\Request;
use DeviTools\Http\AbstractRestController;

/**
 * Class GradeController
 *
 * @package App\Http\Controllers\Api\Admin
 */
class ActivityController extends AbstractRestController
{
    /**
     * ActivityController constructor.
     *
     * @param ActivityRepository $repository
     */
    public function __construct(ActivityRepository $repository)
    {
        parent::__construct($repository);
    }
}

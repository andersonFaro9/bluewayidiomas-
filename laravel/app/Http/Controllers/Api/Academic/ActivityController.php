<?php

namespace App\Http\Controllers\Api\Academic;

use App\Domains\Academic\Activity\ActivityRepository;
use App\Http\Controllers\Api\AbstractRestController;
use Illuminate\Http\Request;

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
     * @param Request $request
     */
    public function __construct(ActivityRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }
}

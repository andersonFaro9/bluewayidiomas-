<?php

namespace App\Http\Controllers\Api\Academic;

use App\Domains\Academic\Grade\GradeRepository;
use App\Http\Controllers\Api\AbstractRestController;
use Illuminate\Http\Request;

/**
 * Class GradeController
 *
 * @package App\Http\Controllers\Api\Academic
 */
class GradeController extends AbstractRestController
{
    /**
     * GradeController constructor.
     *
     * @param GradeRepository $repository
     * @param Request $request
     */
    public function __construct(GradeRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }
}

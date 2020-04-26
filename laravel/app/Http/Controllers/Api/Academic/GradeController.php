<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Academic;

use App\Domains\Academic\Grade\GradeRepository;
use DeviTools\Http\AbstractRestController;

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
     */
    public function __construct(GradeRepository $repository)
    {
        parent::__construct($repository);
    }
}

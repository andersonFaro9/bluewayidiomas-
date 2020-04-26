<?php

namespace App\Domains\Academic\Grade;

use App\Domains\Academic\Grade;
use DeviTools\Persistence\AbstractRepository;

/**
 * Class GradeRepository
 *
 * @package App\Domains\Academic\Grade
 */
class GradeRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected string $prototype = Grade::class;

    /**
     * @return array
     */
    public function getFilterable(): array
    {
        return [
            'name',
            'level',
            'class',
            'shift',
        ];
    }
}

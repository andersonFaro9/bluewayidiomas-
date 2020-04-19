<?php

declare(strict_types=1);

namespace App\Domains\Academic\Shared;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait TeacherGrade
 *
 * @package App\Domains\Academic\Shared
 */
trait TeacherGrade
{
    /**
     * @param Builder $query
     * @param string $userId
     *
     * @return Builder
     */
    protected function queryTeacherGrade(Builder $query, string $userId): Builder
    {
        return $query->whereIn('gradeId', static function ($query) use ($userId) {
            $query->select('uuid')
                ->from('grades')
                ->where('userId', $userId);
        });
}
}
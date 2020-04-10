<?php

namespace App\Core\Repository;

use App\Core\AbstractModel;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait Count
 *
 * @package App\Core\Repository
 * @property AbstractModel model
 */
trait Count
{
    /**
     * @param array $filters
     * @param bool $trash
     *
     * @return int
     */
    public function count(array $filters, $trash = false): int
    {
        /** @var Builder $query */
        $query = $this->where($filters, $trash);

        return $query->count();
    }
}
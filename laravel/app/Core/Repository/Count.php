<?php

namespace App\Core\Repository;

use App\Core\AbstractModel;

/**
 * Trait Count
 *
 * @package App\Core\Repository
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
        /** @var AbstractModel $query */
        $query = $this->where($filters);

        if ($trash) {
            $query = $query::onlyTrashed();
        }

        return $query->count();
    }
}
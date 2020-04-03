<?php

namespace App\Core\Report\Where;

/**
 * Trait WhereLike
 * @package App\Core\Report\Where
 *
 * @property array $where
 */
trait WhereLike
{
    /**
     * @param array $filters
     * @param string $column
     * @param string $property
     * @return $this
     */
    protected function addWhereLike(array &$filters, string $column, string $property = '')
    {
        if (!$property) {
            $property = $column;
        }
        $value = $filters[$property] ?? null;
        if (!$value) {
            return $this;
        }
        $filters[$property] = "%{$filters[$property]}%";
        $this->where[] = "{$column} LIKE :{$property}";
        return $this;
    }
}
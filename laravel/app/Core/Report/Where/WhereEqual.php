<?php


namespace App\Core\Report\Where;

/**
 * Trait WhereEqual
 * @package App\Core\Report\Where
 */
trait WhereEqual
{
    /**
     * @param array $filters
     * @param string $column
     * @param string $property
     * @return $this
     */
    protected function addWhereEqual(array $filters, string $column, string $property = '')
    {
        if (!$property) {
            $property = $column;
        }
        $value = $filters[$property] ?? null;
        if (!$value) {
            return $this;
        }
        $this->where[] = "{$column} = :{$property}";
        return $this;
    }
}
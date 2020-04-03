<?php

namespace App\Core\Repository;

use App\Core\AbstractModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Trait Search
 *
 * @package App\Core\Repository
 * @property AbstractModel model
 */
trait Search
{
    /**
     * @param array $options
     * @param bool $trash
     *
     * @return array
     */
    public function search(array $options = [], $trash = false): array
    {
        $filters = $options['filters'] ?? [];
        $offset = $options['offset'] ?? 0;
        $limit = $options['limit'] ?? 25;
        $sorter = $options['sorter'] ?? null;

        if (!is_array($sorter)) {
            $sorter = $this->model->sorter();
        }

        return $this->filter($filters, $sorter, $offset, $limit, $trash)->toArray();
    }

    /**
     * @param array $filters
     * @param array $sorter
     * @param int $offset
     * @param int $limit
     * @param bool $trash
     *
     * @return AbstractModel[]|Builder[]|Collection|Builder[]|Collection
     */
    public function filter(array $filters, $sorter = [], $offset = 0, $limit = 25, $trash = false)
    {
        /** @var AbstractModel $query */
        $query = $this->where($filters);

        $manyToOne = $this->model->manyToOne();
        foreach (array_keys($manyToOne) as $related) {
            /** @var Builder $query */
            $query = $query->with($related);
        }

        if ($trash) {
            $query = $query::onlyTrashed();
        }

        foreach ($sorter as $column => $direction) {
            $query = $query->orderBy($column, $direction);
        }

        return $query
            ->offset($offset)
            ->limit($limit)
            ->get($this->model->columns());
    }
}
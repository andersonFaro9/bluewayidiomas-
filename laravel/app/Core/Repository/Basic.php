<?php

namespace App\Core\Repository;

use App\Core\AbstractModel;
use App\Core\Filter\Connectors;
use App\Core\Filter\Operators;
use App\Exceptions\ErrorInvalidArgument;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait Basic
 *
 * @package App\Core\Repository
 * @property AbstractModel model
 */
trait Basic
{
    /**
     * @param string $id
     *
     * @return AbstractModel
     */
    protected function pull(string $id): ?AbstractModel
    {
        return $this->where($this->filterById($id))->withTrashed()->get($this->model->columns())->first();
    }

    /**
     * @param array $filters
     * @param bool $trash
     *
     * @return AbstractModel|Builder
     */
    protected function where(array $filters, bool $trash = false)
    {
        $model = clone $this->model;
        $encoded = $model->getEncoded();

        if ($trash) {
            $model = $model::onlyTrashed();
        }

        $where = function (Builder $query) use ($filters, $encoded) {
            $model = $query;
            foreach ($filters as $column => $value) {
                if (is_array($value)) {
                    $model = $this->whereParse($model, $column, $value);
                    continue;
                }
                if (in_array($column, $encoded, true)) {
                    $value = $this->model::encodeUuid($value);
                }
                $model = $model->where($column, $value);
            }
        };
        return $model->where($where);
    }

    /**
     * @param AbstractModel|Builder $model
     * @param string $column
     * @param array $value
     *
     * @return AbstractModel|Builder
     * @throws ErrorInvalidArgument
     */
    protected function whereParse($model, string $column, array $value)
    {
        if (isset($value['operator'], $value['value'])) {
            return $this->whereParseOperator($model, $column, $value);
        }
        if (isset($value['in'])) {
            return $model->whereIn($column, $value['in']);
        }
        throw new ErrorInvalidArgument($value, "Invalid where to '{$column}'");
    }

    /**
     * @param AbstractModel|Builder $model
     * @param string $column
     * @param array $value
     *
     * @return AbstractModel|Builder
     */
    protected function whereParseOperator($model, string $column, array $value)
    {
        $connector = $value['connector'] ?? Connectors::AND_CONNECTOR;
        $operator = strtolower($value['operator'] ?? Operators::EQUAL);
        $filter = $value['value'] ?? null;

        if ($operator === Operators::LIKE) {
            $filter = "%{$filter}%";
        }

        $sign = Operators::sign($operator);
        if (!$sign) {
            return $model;
        }

        if ($connector === Connectors::OR_CONNECTOR) {
            return $model->orWhere($column, $sign, $filter);
        }
        return $model->where($column, $sign, $filter);
    }

    /**
     * @param string $id
     *
     * @return array
     */
    protected function filterById(string $id): array
    {
        $key = $this->referenceKey();
        return [
            $key => AbstractModel::encodeUuid($id)
        ];
    }
}
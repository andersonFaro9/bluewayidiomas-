<?php

namespace App\Core\Repository;

use App\Core\AbstractModel;

use function App\Helper\encodeUuid;
use function App\Helper\is_binary;

/**
 * Trait Helper
 *
 * @package App\Core\Repository
 */
trait Helper
{
    /**
     * @return array
     */
    public function fields(): array
    {
        /** @var AbstractModel $model */
        $model = $this->model;

        $fillable = $model->getFillable();
        $relations = array_keys($model->manyToOne());
        return array_merge($fillable, $relations);
    }

    /**
     * @return string
     */
    public function referenceKey(): string
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->model->getKeyName();
    }

    /**
     * @return string
     */
    public function exposedKey(): string
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->model->exposedKey();
    }

    /**
     * @param string $id
     *
     * @return AbstractModel
     */
    public function findById($id): ?AbstractModel
    {
        if (!is_binary($id)) {
            $id = encodeUuid($id);
        }
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->model->where('uuid', $id)->first();
    }
}

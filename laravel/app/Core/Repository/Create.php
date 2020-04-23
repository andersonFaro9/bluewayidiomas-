<?php

declare(strict_types=1);

namespace App\Core\Repository;

use App\Core\AbstractModel;
use Exception;
use Ramsey\Uuid\Uuid;

/**
 * Trait Create
 *
 * @package App\Core\Repository
 * @property AbstractModel model
 */
trait Create
{
    /**
     * @param array $data
     *
     * @return string
     * @throws Exception
     */
    public function create(array $data): ?string
    {
        $model = clone $this->model;

        $primaryKey = $model->exposedKey();
        if (!isset($data[$primaryKey])) {
            $data[$primaryKey] = Uuid::uuid1()->toString();
        }
        $model->fill($data);
        $model->save();
        return $model->getPrimaryKeyValue();
    }
}

<?php

namespace App\Core\Repository;

use App\Core\AbstractModel;
use Exception;
use Ramsey\Uuid\Uuid;

/**
 * Trait Create
 *
 * @package App\Core\Repository
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
        /** @var AbstractModel $model */
        $model = $this->model;
        if (!isset($data['id'])) {
            $data['id'] = Uuid::uuid1()->toString();
        }
        $model->fill($data)->save();
        return $model->getValue('id');
    }
}

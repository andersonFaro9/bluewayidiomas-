<?php

namespace App\Core\Repository;

use App\Core\AbstractModel;

/**
 * Trait Update
 *
 * @package App\Core\Repository
 */
trait Update
{
    /**
     * @param string $id
     * @param array $data
     *
     * @return string
     */
    public function update(string $id, array $data): ?string
    {
        /** @var AbstractModel $instance */
        $instance = $this->pull($id);
        if ($instance === null) {
            return null;
        }
        $instance->fill($data)->save();
        return $instance->getValue('id');
    }
}
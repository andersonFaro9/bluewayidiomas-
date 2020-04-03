<?php

namespace App\Core\Repository;

use App\Core\AbstractModel;
use Exception;

/**
 * Trait Delete
 *
 * @package App\Core\Repository
 */
trait Delete
{
    /**
     * @param string $id
     *
     * @return string
     * @throws Exception
     */
    public function delete(string $id): ?string
    {
        /** @var AbstractModel $instance */
        $instance = $this->pull($id);
        if ($instance === null) {
            return null;
        }
        $instance->delete();
        return $instance->getValue('id');
    }
}
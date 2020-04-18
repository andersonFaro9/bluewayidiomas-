<?php

namespace App\Core\Repository;

use App\Core\AbstractModel;
use Exception;

/**
 * Trait Destroy
 *
 * @package App\Core\Repository
 */
trait Destroy
{
    /**
     * @param string $id
     *
     * @return string
     * @throws Exception
     */
    public function destroy(string $id): ?string
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
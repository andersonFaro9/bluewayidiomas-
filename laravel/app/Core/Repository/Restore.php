<?php

declare(strict_types=1);

namespace App\Core\Repository;

use App\Core\AbstractModel;

/**
 * Trait Restore
 *
 * @package App\Core\Repository
 */
trait Restore
{
    /**
     * @param string $id
     *
     * @return string
     */
    public function restore(string $id): ?string
    {
        /** @var AbstractModel $instance */
        $instance = $this->pull($id);
        if ($instance === null) {
            return null;
        }
        $instance->restore();
        return $instance->getValue('id');
    }
}
<?php

declare(strict_types=1);

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
     * @param bool $erase
     *
     * @return string
     * @throws Exception
     */
    public function destroy(string $id, $erase = false): ?string
    {
        /** @var AbstractModel $instance */
        $instance = $this->pull($id);
        if ($instance === null) {
            return null;
        }
        if ($erase) {
            $instance->forceDelete();
            return $id;
        }
        $instance->delete();
        return $id;
    }
}
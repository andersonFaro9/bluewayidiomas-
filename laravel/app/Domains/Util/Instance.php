<?php

namespace App\Domains\Util;

/**
 * Trait Instance
 *
 * @package App\Domains
 */
trait Instance
{
    /**
     * Create a instance of this class
     *
     * @param array $parameters
     *
     * @return $this
     */
    public static function instance(array $parameters = []): self
    {
        return app(static::class, $parameters);
    }
}

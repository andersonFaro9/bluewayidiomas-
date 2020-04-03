<?php

namespace App\Core\Model;

use function App\Helper\decodeUuid;
use function App\Helper\encodeUuid;

/**
 * Trait Helper
 * @package App\Core\Model
 */
trait Helper
{
    /**
     * @param $value
     * @return string
     */
    public static function encodeUuid($value)
    {
        return encodeUuid($value);
    }

    /**
     * @param $value
     * @return string
     */
    public static function decodeUuid($value)
    {
        return decodeUuid($value);
    }
}
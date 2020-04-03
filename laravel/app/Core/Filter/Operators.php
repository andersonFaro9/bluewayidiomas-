<?php

namespace App\Core\Filter;

/**
 * Class Operators
 *
 * @package App\Core\Filter
 */
final class Operators
{
    /**
     * @var string
     */
    public const SEPARATOR = '~';

    /**
     * @var string
     */
    public const EQUAL = 'eq';

    /**
     * @var string
     */
    public const LIKE = 'like';

    /**
     * Operators constructor.
     */
    private function __construct()
    {
    }

    public static function sign(string $operator)
    {
        $signs = [
            static::EQUAL => '=',
            static::LIKE => 'like',
        ];
        return $signs[$operator] ?? null;
    }
}
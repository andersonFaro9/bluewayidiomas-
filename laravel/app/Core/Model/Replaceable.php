<?php
/** @noinspection PhpUnused */

namespace App\Core\Model;

/**
 * Trait Replaceable
 * @package App\Core\Model
 */
trait Replaceable
{
    /**
     * @var array
     */
    protected $encoded = [];

    /**
     * @return array
     */
    public function getEncoded()
    {
        return $this->encoded;
    }

    /**
     * @return array
     */
    public function sorter(): array
    {
        return ['createdAt' => 'ASC'];
    }

    /**
     * @return array
     */
    public function manyToOne(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function manyToMany(): array
    {
        return [];
    }

    /**
     * @return void
     */
    protected static function configure(): void
    {
    }
}
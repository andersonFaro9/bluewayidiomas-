<?php  /** @noinspection PhpUnused */

declare(strict_types=1);

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
    protected array $encoded = [];

    /**
     * @return array
     */
    public function getEncoded(): array
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
     * @return array
     */
    public function currencies(): array
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
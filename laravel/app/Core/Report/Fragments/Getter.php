<?php

namespace App\Core\Report\Fragments;

/**
 * Trait Getters
 * @package App\Core\Report\Fragments
 */
trait Getter
{
    /**
     * @var string
     */
    protected $user;

    /**
     * @var string
     */
    protected $title = '';

    /**
     * @var array
     */
    protected $filters;

    /**
     * @var array
     */
    protected $where = [];

    /**
     * @var array
     */
    protected $collection;

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return $this->filters;
    }

    /**
     * @return array
     */
    public function getCollection(): array
    {
        return $this->collection;
    }
}
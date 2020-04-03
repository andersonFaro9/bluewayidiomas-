<?php

namespace App\Core;

/**
 * Interface RepositoryInterface
 * @package App\Domains
 */
interface RepositoryInterface
{
    /**
     * @param array $data
     * @return string
     */
    public function create(array $data): ?string;

    /**
     * @param string $id
     * @param bool $trash
     * @return ModelInterface
     */
    public function read(string $id, $trash = false): ?ModelInterface;

    /**
     * @param string $id
     * @param array $data
     * @return string
     */
    public function update(string $id, array $data): ?string;

    /**
     * @param string $id
     * @return string
     */
    public function delete(string $id): ?string;

    /**
     * @param string $id
     * @return string
     */
    public function restore(string $id): ?string;

    /**
     * @param array $options
     * @param bool $trash
     * @return array
     */
    public function search(array $options = [], $trash = false): array;

    /**
     * @param array $filters
     * @param bool $trash
     * @return int
     */
    public function count(array $filters, $trash = false): int;

    /**
     * @return array
     */
    public function getFilterable(): array;

    /**
     * @return array
     */
    public function getManyToOne(): array;
}

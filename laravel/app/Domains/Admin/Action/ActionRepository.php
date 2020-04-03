<?php

namespace App\Domains\Admin\Action;

use App\Domains\Admin\Action;
use App\Domains\Admin\ProfileAction;
use App\Core\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use function PhpBrasil\Collection\pack as pack;

/**
 * Class ActionRepository
 * @package Domains\Admin\Action
 */
class ActionRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected $prototype = Action::class;

    /**
     * @param string $profileId
     * @return array
     */
    public function actions(string $profileId): array
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $actions = $this->model
            ->whereIn('uuid', function (Builder $query) use ($profileId) {
                /** @var Builder $query */
                $query->select('actionId')
                    ->from(with(new ProfileAction())->getTable())
                    ->where('profileId', $profileId);
            })
            ->orderBy('actionId')
            ->orderBy('assortment')
            ->get();

        /** @var Collection $actions */
        return $actions->reduce(function ($accumulator, $action) {
            $parent = $action->parent;
            $id = $action->id;
            if (isset($accumulator[$id])) {
                return $accumulator;
            }
            if (!$parent) {
                $accumulator[$id] = $action;
                return $accumulator;
            }
            $parentId = $parent->id;
            if (!isset($accumulator[$parentId])) {
                $accumulator[$parentId] = $parent;
            }
            if (!isset($accumulator[$parentId]->children)) {
                $accumulator[$parentId]->children = [];
            }
            $accumulator[$parentId]->children[] = $action;
            return $accumulator;
        }, []);
    }

    /**
     * @return array
     */
    public function getFilterable(): array
    {
        return ['name', 'namespace', 'path'];
    }
}

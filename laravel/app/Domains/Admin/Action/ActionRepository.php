<?php

declare(strict_types=1);

namespace App\Domains\Admin\Action;

use App\Domains\Admin\Action;
use App\Domains\Admin\ProfileAction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use DeviTools\Persistence\AbstractRepository;

use function PhpBrasil\Collection\pack as pack;

/**
 * Class ActionRepository
 *
 * @package Domains\Admin\Action
 */
class ActionRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected string $prototype = Action::class;

    /**
     * @param string $profileId
     *
     * @return array
     */
    public function actions(string $profileId): array
    {
        $actions = $this->model
            ->whereIn(
                'uuid',
                function (Builder $query) use ($profileId) {
                    $query->select('actionId')
                        ->from(with(new ProfileAction())->getTable())
                        ->where('profileId', $profileId);
                }
            )
            ->orderBy('actionId')
            ->orderBy('assortment')
            ->get();

        /** @var Collection $actions */
        $tree = $actions->reduce(
            function ($accumulator, Action $action) {
                $parent = $action->parent;
                $id = $action->id;

                if (!$parent) {
                    $accumulator[$id] = $action->export();
                    return $accumulator;
                }

                $this->appendToParent($accumulator, $parent->id, $action);
                return $accumulator;
            },
            []
        );

        $callback = static function ($action) {
            if (!isset($action['children'])) {
                return $action;
            }
            if (!count($action['children'])) {
                unset($action['children']);
                return $action;
            }
            $action['children'] = array_values($action['children']);
            return $action;
        };
        return pack(array_values($tree))->map($callback)->records();
    }

    /**
     * @param $accumulator
     * @param string $parentId
     * @param Action $kid
     */
    protected function appendToParent(array &$accumulator, string $parentId, Action $kid): void
    {
        /** @var Action $action */
        foreach ($accumulator as &$action) {
            $id = $action['id'];

            if ($id !== $parentId) {
                $this->appendToParent($action['children'], $parentId, $kid);
                continue;
            }

            $action['children'][$kid->id] = $kid->export();
            return;
        }
    }

    /**
     * @return array
     */
    public function getFilterable(): array
    {
        return ['name', 'namespace', 'path'];
    }
}

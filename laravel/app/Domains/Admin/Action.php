<?php

namespace App\Domains\Admin;

use App\Core\AbstractModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ramsey\Uuid\Uuid;

/**
 * Class Action
 *
 * @property mixed parent
 * @package Domains\Admin
 */
class Action extends AbstractModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'actions';

    /**
     * @var array
     */
    public $children = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'actionId',
        'name',
        'namespace',
        'icon',
        'path',
        'separated',
        'assortment',
    ];

    /**
     * @var array
     */
    protected $rules = [
        'name' => 'required',
        'namespace' => ['required'],
    ];

    /**
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(static::class, 'actionId', 'uuid');
    }

    /**
     * @return array
     */
    public function manyToOne(): array
    {
        return ['parent' => 'actionId'];
    }

    /**
     * @return array
     */
    public function sorter(): array
    {
        return ['actionId' => 'ASC', 'assortment' => 'ASC', 'createdAt' => 'ASC'];
    }

    /**
     * Convert the model instance to an array.
     *
     * @return mixed
     */
    public function export()
    {
        $data = $this->toArray();
        $data['children'] = [];
        unset($data['parent'], $data['updatedAt'], $data['createdAt'], $data['deletedAt']);
        return $data;
    }
}

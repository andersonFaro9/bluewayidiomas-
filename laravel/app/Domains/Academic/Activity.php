<?php

namespace App\Domains\Academic;

use App\Core\AbstractModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Activity
 *
 * @package App\Domains\Academic
 */
class Activity extends AbstractModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'activities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gradeId',
        'type',
        'documentType',
        'linkType',
        'name',
        'description',
        'document',
        'link',
    ];

    /**
     * @var array
     */
    protected $rules = [
        'gradeId' => 'required',
        'type' => 'required',
        'name' => 'required',
        'description' => 'required',
    ];

    /**
     * @return array
     */
    public function manyToOne(): array
    {
        return ['grade' => 'gradeId'];
    }

    /**
     * @return BelongsTo
     */
    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class, 'gradeId', 'uuid');
    }

    /**
     * @return string
     */
    public function prefix(): string
    {
        return 'academic.activity';
    }
}

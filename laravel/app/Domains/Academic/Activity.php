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
        'name',
        'gradeId',
    ];

    /**
     * @var array
     */
    protected $rules = [
        'name' => 'required',
        'gradeId' => 'required',
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
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Grade::class, 'gradeId', 'uuid', 'grade');
    }
}

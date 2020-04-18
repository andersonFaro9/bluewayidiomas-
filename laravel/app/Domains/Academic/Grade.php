<?php

namespace App\Domains\Academic;

use App\Core\AbstractModel;

/**
 * Class Grade
 *
 * @package App\Domains\Academic
 */
class Grade extends AbstractModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'grades';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'shift',
    ];

    /**
     * @var array
     */
    protected $rules = [
        'name' => 'required',
        'shift' => ['required'],
    ];

    /**
     * @return string
     */
    public function prefix(): string
    {
        return 'academic.grade';
    }
}

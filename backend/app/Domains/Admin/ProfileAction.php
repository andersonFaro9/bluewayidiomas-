<?php

namespace App\Domains\Admin;

use Illuminate\Database\Eloquent\Relations\Pivot as Model;

/**
 * Class ProfileAction
 * @package App\Domains\Admin
 */
class ProfileAction extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'profileId' => 'string',
        'actionId' => 'string',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profile_action';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profileId',
        'actionId',
    ];

    /**
     * @var array
     */
    protected $rules = [
        'profileId' => ['required'],
        'actionId' => ['required'],
    ];
}

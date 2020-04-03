<?php

namespace App\Http\Controllers\Api\Admin;

use App\Domains\Admin\Profile\ProfileRepository;
use App\Http\Controllers\Api\AbstractRestController;
use Illuminate\Http\Request;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Api\Admin
 */
class ProfileController extends AbstractRestController
{
    /**
     * ProfileController constructor.
     * @param ProfileRepository $repository
     * @param Request $request
     */
    public function __construct(ProfileRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }
}

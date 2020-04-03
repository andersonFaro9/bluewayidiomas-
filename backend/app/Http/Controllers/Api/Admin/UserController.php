<?php

namespace App\Http\Controllers\Api\Admin;

use App\Domains\Admin\User\UserRepository;
use App\Http\Controllers\Api\AbstractRestController;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers\Api\Admin
 */
class UserController extends AbstractRestController
{
    /**
     * User constructor.
     * @param UserRepository $repository
     * @param Request $request
     */
    public function __construct(UserRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }
}

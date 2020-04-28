<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Admin;

use App\Domains\Admin\User\UserRepository;
use DeviTools\Http\AbstractRestController;

/**
 * Class UserController
 * @package App\Http\Controllers\Api\Admin
 */
class UserController extends AbstractRestController
{
    /**
     * User constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }
}

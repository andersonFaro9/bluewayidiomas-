<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Admin;

use App\Domains\Admin\Profile\ProfileRepository;
use DeviTools\Http\AbstractRestController;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Api\Admin
 */
class ProfileController extends AbstractRestController
{
    /**
     * ProfileController constructor.
     * @param ProfileRepository $repository
     */
    public function __construct(ProfileRepository $repository)
    {
        parent::__construct($repository);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Academic;

use App\Domains\Academic\Registration\RegistrationRepository;
use App\Http\Controllers\Api\AbstractRestController;
use Illuminate\Http\Request;

/**
 * Class RegistrationController
 *
 * @package App\Http\Controllers\Api\Academic
 */
class RegistrationController extends AbstractRestController
{
    /**
     * RegistrationController constructor.
     *
     * @param RegistrationRepository $repository
     * @param Request $request
     */
    public function __construct(RegistrationRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }
}

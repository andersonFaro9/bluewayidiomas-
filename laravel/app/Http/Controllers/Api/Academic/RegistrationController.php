<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Academic;

use App\Domains\Academic\Registration\RegistrationRepository;
use DeviTools\Http\AbstractRestController;

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
     */
    public function __construct(RegistrationRepository $repository)
    {
        parent::__construct($repository);
    }
}

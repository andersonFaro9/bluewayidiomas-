<?php

declare(strict_types=1);

namespace App\Domains\Academic\Registration;

use App\Domains\Academic\Registration;
use DeviTools\Persistence\AbstractRepository as Repository;

/**
 * Class RegistrationRepository
 *
 * @package App\Domains\Academic\Registration
 */
class RegistrationRepository extends Repository
{
    /**
     * The entity class name used in repository
     *
     * @var string
     */
    protected string $prototype = Registration::class;
}

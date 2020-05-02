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

    /**
     * @param string $binaryUuid
     *
     * @return array
     */
    public function getInfo(string $binaryUuid): array
    {
        // ['userId' => Uuid::fromString($user->id)->getBytes()]
        /** @var Registration $registration */
        $registration = $this->model->where('userId', $binaryUuid)->first();
        return [
            'grade' => $registration->grade->name,
            'level' => $registration->grade->level,
            'time' => $registration->grade->shift,
        ];
    }
}

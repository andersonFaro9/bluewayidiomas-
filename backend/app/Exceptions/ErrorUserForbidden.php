<?php

namespace App\Exceptions;

use App\Http\Status;

/**
 * Class ErrorUserForbidden
 * @package App\Exceptions
 */
class ErrorUserForbidden extends ErrorGeneral
{
    /**
     * @var int
     */
    protected $statusCode = Status::CODE_403;

    /**
     * @var int
     */
    protected $defaultMessage = 'Invalid credentials';
}

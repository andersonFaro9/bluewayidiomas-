<?php

namespace App\Exceptions;

use App\Http\Status;

/**
 * Class ErrorUserInative
 * @package App\Exceptions
 */
class ErrorUserInative extends ErrorGeneral
{
    /**
     * @var int
     */
    protected $statusCode = Status::CODE_402;

    /**
     * @var int
     */
    protected $defaultMessage = 'Invalid credentials';
}

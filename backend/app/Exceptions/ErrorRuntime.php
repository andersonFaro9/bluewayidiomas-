<?php

namespace App\Exceptions;

use App\Http\Status;

/**
 * Class ErrorRuntime
 * @package App\Exceptions
 */
class ErrorRuntime extends ErrorGeneral
{
    /**
     * @var int
     */
    protected $statusCode = Status::CODE_500;

    /**
     * @var int
     */
    protected $defaultMessage = 'Unknown error';
}

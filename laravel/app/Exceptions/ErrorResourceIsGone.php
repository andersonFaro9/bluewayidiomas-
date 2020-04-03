<?php

namespace App\Exceptions;

use App\Http\Status;

/**
 * Class ErrorResourceIsGone
 * @package App\Exceptions
 */
class ErrorResourceIsGone extends ErrorGeneral
{
    /**
     * @var int
     */
    protected $statusCode = Status::CODE_410;

    /**
     * @var int
     */
    protected $defaultMessage = 'Gone';
}

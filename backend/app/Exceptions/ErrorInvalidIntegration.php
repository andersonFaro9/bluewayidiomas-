<?php

namespace App\Exceptions;

use App\Http\Status;

/**
 * Class ErrorInvalidTabulationData
 * @package App\Exceptions
 */
class ErrorInvalidIntegration extends ErrorGeneral
{
    /**
     * @var int
     */
    protected $statusCode = Status::CODE_400;

    /**
     * @var int
     */
    protected $defaultMessage = 'Invalid values to integration';
}

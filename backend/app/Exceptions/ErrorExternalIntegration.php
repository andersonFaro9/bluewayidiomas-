<?php
/**
 *
 */

namespace App\Exceptions;

/**
 * Class ErrorExternalIntegration
 * @package App\Exceptions
 */
class ErrorExternalIntegration extends ErrorGeneral
{
    /**
     * ErrorExternalIntegration constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct([], $message);
    }
}

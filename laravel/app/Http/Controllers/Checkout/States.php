<?php

namespace App\Http\Controllers\Checkout;

/**
 * Class States
 *
 * @package App\Http\Controllers\Checkout
 */
abstract class States
{
    /**
     * @var string
     */
    public const STATE_PENDING = 'pending';

    /**
     * @var string
     */
    public const STATE_EXECUTED = 'executed';

    /**
     * @var string
     */
    public const STATE_CANCELED = 'canceled';
}
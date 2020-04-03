<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as Laravel;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
abstract class Controller extends Laravel
{
    /**
     * @see AuthorizesRequests
     * @see DispatchesJobs
     * @see ValidatesRequests
     */
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;
}

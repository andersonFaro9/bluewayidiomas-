<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class Success
 *
 * @package Http\Controllers\Checkout
 */
class Success extends Controller
{
    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @param Request $request
     *
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke(Request $request)
    {
        return view('checkout.success');
    }
}
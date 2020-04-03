<?php

namespace App\Http\Controllers\Api\Gateway;

use App\Domains\Gateway\Shop\ShopRepository;
use App\Http\Controllers\Api\AbstractRestController;
use Illuminate\Http\Request;

/**
 * Class ShopController
 * @package App\Http\Controllers\Api\Gateway
 */
class ShopController extends AbstractRestController
{
    /**
     * ShopController constructor.
     * @param ShopRepository $repository
     * @param Request $request
     */
    public function __construct(ShopRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }
}

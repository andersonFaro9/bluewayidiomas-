<?php

namespace App\Http\Controllers\Api\Admin;

use App\Domains\Admin\Action\ActionRepository;
use App\Http\Controllers\Api\AbstractRestController;
use Illuminate\Http\Request;

/**
 * Class ActionController
 * @package App\Http\Controllers\Api\Admin
 */
class ActionController extends AbstractRestController
{
    /**
     * ActionController constructor.
     * @param ActionRepository $repository
     * @param Request $request
     */
    public function __construct(ActionRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }
}

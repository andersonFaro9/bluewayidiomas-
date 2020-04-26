<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Admin;

use App\Domains\Admin\Action\ActionRepository;
use DeviTools\Http\AbstractRestController;

/**
 * Class ActionController
 * @package App\Http\Controllers\Api\Admin
 */
class ActionController extends AbstractRestController
{
    /**
     * ActionController constructor.
     * @param ActionRepository $repository
     */
    public function __construct(ActionRepository $repository)
    {
        parent::__construct($repository);
    }
}

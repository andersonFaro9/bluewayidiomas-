<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Rest\Create;
use App\Http\Controllers\Api\Rest\Destroy;
use App\Http\Controllers\Api\Rest\Read;
use App\Http\Controllers\Api\Rest\Restore;
use App\Http\Controllers\Api\Rest\Search;
use App\Http\Controllers\Api\Rest\Update;

/**
 * Class AbstractRestController
 *
 * @package App\Http\Controllers\Api
 */
abstract class AbstractRestController extends AbstractPersistenceController implements RestControllerInterface
{
    /**
     * Basic operations
     */
    use Create;
    use Destroy;
    use Read;
    use Restore;
    use Search;
    use Update;
}

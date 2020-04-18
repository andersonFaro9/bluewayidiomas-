<?php

namespace App\Http\Controllers\Api;

use App\Core\AbstractRepository;
use App\Core\RepositoryInterface;
use App\Http\Controllers\Api\Rest\Create;
use App\Http\Controllers\Api\Rest\Delete;
use App\Http\Controllers\Api\Rest\Read;
use App\Http\Controllers\Api\Rest\Restore;
use App\Http\Controllers\Api\Rest\Search;
use App\Http\Controllers\Api\Rest\Update;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

/**
 * Class AbstractRestController
 *
 * @package App\Http\Controllers\Api
 */
abstract class AbstractRestController extends AbstractAnswerController implements RestControllerInterface
{
    /**
     * Basic operations
     */
    use Create;
    use Delete;
    use Read;
    use Restore;
    use Search;
    use Update;

    /**
     * @var AbstractRepository
     */
    protected $repository;

    /**
     * @var Request
     */
    protected $request;

    /**
     * AbstractRestController constructor.
     *
     * @param RepositoryInterface $repository
     * @param Request $request [null]
     */
    public function __construct(RepositoryInterface $repository, Request $request = null)
    {
        $this->repository = $repository;
        $this->request = $request;
    }

    /**
     * @return RepositoryInterface
     */
    final protected function repository(): RepositoryInterface
    {
        return $this->repository;
    }

    /**
     * @param string $id
     * @param array $data
     *
     * @return array
     */
    protected function prepareRecord(string $id, array $data): array
    {
        foreach ($data as $field => &$value) {
            if ($value instanceof UploadedFile) {
                $value = $this->parseFile($id, $field, $value);
            }
        }
        return $data;
    }

    /**
     * @param string $id
     * @param string $field
     * @param UploadedFile $file
     *
     * @return string
     */
    protected function parseFile(string $id, string $field, UploadedFile $file): string
    {
        $domain = $this->repository()->prefix();
        $path = "{$domain}/$id";
        $extension = $file->getClientOriginalExtension();
        $name = "{$field}.{$extension}";
        return $file->storeAs($path, $name);
    }
}

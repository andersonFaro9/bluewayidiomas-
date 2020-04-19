<?php

namespace App\Http\Controllers\Api;

use App\Core\AbstractRepository;
use App\Core\RepositoryInterface;
use App\Exceptions\ErrorExternalIntegration;
use App\Http\Controllers\Api\Rest\Create;
use App\Http\Controllers\Api\Rest\Destroy;
use App\Http\Controllers\Api\Rest\Read;
use App\Http\Controllers\Api\Rest\Restore;
use App\Http\Controllers\Api\Rest\Search;
use App\Http\Controllers\Api\Rest\Update;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
    use Destroy;
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
    protected ?Request $request;

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
     * @throws ErrorExternalIntegration
     */
    public function prepareRecord(string $id, array $data): array
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
     * @throws ErrorExternalIntegration
     */
    protected function parseFile(string $id, string $field, UploadedFile $file): string
    {
        $domain = $this->repository()->prefix();
        $extension = $file->getClientOriginalExtension();
        $path = "{$domain}/$id/{$field}";
        if (!Storage::disk('minio')->put($path, File::get($file->getRealPath()))) {
            throw new ErrorExternalIntegration('Cloud storage not available');
        }
        return "{$domain}/$id/{$field}.{$extension}";
    }
}

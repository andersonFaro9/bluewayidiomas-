<?php

namespace App\Http\Controllers\Api\Rest;

use App\Core\RepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

/**
 * Trait Create
 * @package App\Http\Controllers\Api\Rest
 * @method RepositoryInterface repository()
 */
trait Create
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function create(Request $request): JsonResponse
    {
        $data = $request->all();
        if (!$data) {
            return $this->answerFail(['payload' => 'empty']);
        }

        if (!isset($data['id'])) {
            $data['id'] = Uuid::uuid1()->toString();
        }
        $id = $data['id'];
        $created = $this->repository()->create($this->prepareRecord($id, $data));

        return $this->answerSuccess(['ticket' => $created]);
    }
}
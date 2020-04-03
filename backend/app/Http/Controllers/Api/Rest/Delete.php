<?php

namespace App\Http\Controllers\Api\Rest;

use App\Core\RepositoryInterface;
use App\Exceptions\ErrorInvalidArgument;
use App\Exceptions\ErrorResourceIsGone;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Trait Delete
 * @package App\Http\Controllers\Api\Rest
 * @method RepositoryInterface repository()
 */
trait Delete
{
    /**
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     * @throws ErrorResourceIsGone
     */
    public function delete(Request $request, string $id): JsonResponse
    {
        $details = ['id' => $id];
        $deleted = $this->repository()->delete($id);
        if ($deleted) {
            return $this->answerSuccess(['ticket' => $deleted]);
        }
        if (is_null($deleted)) {
            throw new ErrorResourceIsGone($details);
        }
        return $this->answerFail($details);
    }
}
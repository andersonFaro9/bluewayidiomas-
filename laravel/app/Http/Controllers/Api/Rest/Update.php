<?php

namespace App\Http\Controllers\Api\Rest;

use App\Core\RepositoryInterface;
use App\Exceptions\ErrorResourceIsGone;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Trait Update
 * @package App\Http\Controllers\Api\Rest
 * @method RepositoryInterface repository()
 */
trait Update
{
    /**
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     * @throws ErrorResourceIsGone
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $data = $request->post();
        if (!$data) {
            return $this->answerFail(['payload' => 'empty']);
        }
        $details = ['id' => $id];

        $updated = $this->repository()->update($id, $data);
        if ($updated) {
            return $this->answerSuccess(['ticket' => $updated]);
        }
        if (is_null($updated)) {
            throw new ErrorResourceIsGone($details);
        }
        return $this->answerFail($details);
    }
}
<?php

namespace App\Http\Controllers\Api\Rest;

use App\Core\RepositoryInterface;
use App\Exceptions\ErrorResourceIsGone;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Trait Destroy
 * @package App\Http\Controllers\Api\Rest
 * @method RepositoryInterface repository()
 */
trait Destroy
{
    /**
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     * @throws ErrorResourceIsGone
     */
    public function destroy(Request $request, string $id): JsonResponse
    {
        $ids = [$id];
        preg_match_all("/^\[(?<uuid>.*)]$/", $id, $matches);
        if (isset($matches['uuid'][0])) {
            $ids = explode(',', $matches['uuid'][0]);
        }

        $executed = [];
        foreach ($ids as $detail) {
            $deleted = $this->repository()->destroy($detail);
            if ($deleted === null) {
                continue;
            }
            $executed[] = $detail;
        }

        if (count($ids) !== count($executed)) {
            throw new ErrorResourceIsGone(['id' => array_diff($ids, $executed)]);
        }
        return $this->answerSuccess(['ticket' => $ids]);
    }
}
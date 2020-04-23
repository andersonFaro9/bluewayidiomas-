<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Rest;

use App\Core\RepositoryInterface;
use App\Exceptions\ErrorResourceIsGone;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Trait Delete
 *
 * @package App\Http\Controllers\Api\Rest
 * @method RepositoryInterface repository()
 */
trait Destroy
{
    /**
     * @param Request $request
     * @param string $id
     *
     * @return JsonResponse
     * @throws ErrorResourceIsGone
     */
    public function destroy(Request $request, string $id): JsonResponse
    {
        $erase = $request->get('erase');
        $ids = [$id];
        preg_match_all("/^\[(?<uuid>.*)]$/", $id, $matches);
        if (isset($matches['uuid'][0])) {
            $ids = explode(',', $matches['uuid'][0]);
        }

        $executed = [];
        foreach ($ids as $identifier) {
            $deleted = $this->repository()->destroy($identifier, $erase);
            if ($deleted === null) {
                continue;
            }
            $executed[] = $identifier;
        }

        if (count($ids) !== count($executed)) {
            throw new ErrorResourceIsGone(['id' => array_diff($ids, $executed)]);
        }
        return $this->answerSuccess(['ticket' => $ids]);
    }
}
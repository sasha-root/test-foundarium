<?php declare(strict_types=1);

namespace Api\UI\User\Http\Controllers;

use Api\Application\User\Query\Queries\FetchUserCollectionQuery;
use Api\UI\Common\Http\Controllers\Controller;
use Api\UI\User\Http\Requests\FetchUserListRequest;
use Api\Application\User\Query\Handlers\FetchUserCollectionHandler;
use Illuminate\Http\JsonResponse;

class FetchAllUserController extends Controller
{
    public function __construct(
        private FetchUserCollectionHandler $handler
    ) {

    }

    /**
     * @param FetchUserListRequest $request
     * @return JsonResponse
     */
    public function __invoke(FetchUserListRequest $request): JsonResponse
    {
        $query = new FetchUserCollectionQuery($request->getData());
        return response()->json($this->handler->handle($query)->toArray());
    }
}

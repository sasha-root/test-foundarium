<?php declare(strict_types=1);

namespace Api\UI\Car\Http\Controllers;

use Api\UI\Common\Http\Controllers\Controller;
use Api\UI\Car\Http\Requests\FetchCarListRequest;
use Api\Application\Car\Query\Handlers\FetchCarCollectionHandler;
use Api\Application\Car\Query\Queries\FetchCarCollectionQuery;
use Illuminate\Http\JsonResponse;

class FetchAllCarController extends Controller
{
    public function __construct(
        private readonly FetchCarCollectionHandler $handler
    ) {

    }

    /**
     * @param FetchCarListRequest $request
     * @return JsonResponse
     */
    public function __invoke(FetchCarListRequest $request): JsonResponse
    {
        $query = new FetchCarCollectionQuery($request->getData());
        return response()->json($this->handler->handle($query)->toArray());
    }
}

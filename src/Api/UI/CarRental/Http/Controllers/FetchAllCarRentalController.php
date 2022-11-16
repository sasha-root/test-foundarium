<?php declare(strict_types=1);

namespace Api\UI\CarRental\Http\Controllers;

use Api\UI\Common\Http\Controllers\Controller;
use Api\Application\CarRental\Query\Queries\FetchCarRentalCollectionQuery;
use Api\UI\CarRental\Http\Requests\FetchCarRentalListRequest;
use Api\Application\CarRental\Query\Handlers\FetchCarRentalCollectionHandler;
use Illuminate\Http\JsonResponse;

class FetchAllCarRentalController extends Controller
{
    public function __construct(
        private readonly FetchCarRentalCollectionHandler $handler
    ) {

    }

    public function __invoke(FetchCarRentalListRequest $request): JsonResponse
    {
        $query = new FetchCarRentalCollectionQuery($request->getData());
        return response()->json($this->handler->handle($query)->toArray());
    }
}

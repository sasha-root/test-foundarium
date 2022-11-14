<?php declare(strict_types=1);

namespace Api\UI\Car\Http\Controllers;

use Api\UI\Common\Http\Controllers\Controller;
use Api\Application\Car\Query\Handlers\FetchCarHandler;
use Api\Application\Car\Query\Queries\FetchCarQuery;
use Api\Domain\Car\Exception\CarNotFoundException;
use Api\Application\Car\Query\Views\CarView;
use Api\UI\Car\Http\Requests\FetchCarRequest;
use Illuminate\Http\JsonResponse;

class FetchOneCarController extends Controller
{
    public function __construct(
        private FetchCarHandler $handler
    ) {

    }

    /**
     * @param FetchCarRequest $request
     * @return JsonResponse
     * @throws CarNotFoundException
     */
    public function __invoke(FetchCarRequest $request): JsonResponse
    {
        $query = new FetchCarQuery($request->getCarId());
        return response()->json($this->handler->handle($query));
    }
}

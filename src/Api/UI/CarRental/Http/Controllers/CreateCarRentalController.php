<?php declare(strict_types=1);

namespace Api\UI\CarRental\Http\Controllers;

use Api\UI\Common\Http\Controllers\Controller;
use Api\UI\CarRental\Http\Requests\PostCarRentalRequest;
use Api\Application\CarRental\Command\Commands\CreateCarRentalCommand;
use Api\Application\CarRental\Command\Handlers\CreateCarRentalHandler;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CreateCarRentalController extends Controller
{
    public function __construct(
        private readonly CreateCarRentalHandler $handler
    ) {

    }

    public function __invoke(PostCarRentalRequest $request): JsonResponse
    {
        $command = new CreateCarRentalCommand($request);
        return response()->json($this->handler->handle($command), ResponseAlias::HTTP_CREATED);
    }
}

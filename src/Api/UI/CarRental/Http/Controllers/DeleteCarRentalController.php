<?php declare(strict_types=1);

namespace Api\UI\CarRental\Http\Controllers;

use Api\UI\CarRental\Http\Requests\DeleteCarRentalRequest;
use Api\UI\Common\Http\Controllers\Controller;
use Api\Application\CarRental\Command\Commands\DeleteCarRentalCommand;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Api\Application\CarRental\Command\Handlers\DeleteCarRentalHandler;
use Api\Domain\CarRental\Exception\CarRentalNotFoundException;

class DeleteCarRentalController extends Controller
{
    public function __construct(
        private readonly DeleteCarRentalHandler $handler
    ) {

    }

    /**
     * @param DeleteCarRentalRequest $request
     * @return JsonResponse
     * @throws CarRentalNotFoundException
     */
    public function __invoke(DeleteCarRentalRequest $request): JsonResponse
    {
        $command = new DeleteCarRentalCommand($request->getCarRentalId());
        $this->handler->handle($command);

        return response()->json(null, ResponseAlias::HTTP_NO_CONTENT);
    }
}

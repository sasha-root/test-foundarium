<?php declare(strict_types=1);

namespace Api\UI\Car\Http\Controllers;

use Api\UI\Common\Http\Controllers\Controller;
use Api\UI\Car\Http\Requests\DeleteCarRequest;
use Api\Application\Car\Command\Commands\DeleteCarCommand;
use Api\Application\Car\Command\Handlers\DeleteCarHandler;
use Api\Domain\Car\Exception\CarNotFoundException;
use Api\Domain\Car\Exception\CarNotAvailableDeleteException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Illuminate\Http\JsonResponse;

class DeleteCarController extends Controller
{
    public function __construct(
        private DeleteCarHandler $handler
    ) {

    }

    /**
     * @param DeleteCarRequest $request
     * @return JsonResponse
     * @throws CarNotFoundException|CarNotAvailableDeleteException
     */
    public function __invoke(DeleteCarRequest $request): JsonResponse
    {
        $command = new DeleteCarCommand($request->getCarId());
        $this->handler->handle($command);
        return response()->json(null, ResponseAlias::HTTP_NO_CONTENT);
    }
}

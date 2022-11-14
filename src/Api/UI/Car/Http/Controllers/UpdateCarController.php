<?php declare(strict_types=1);

namespace Api\UI\Car\Http\Controllers;

use Api\UI\Common\Http\Controllers\Controller;
use Api\Application\Car\Command\Commands\UpdateCarCommand;
use Api\Application\Car\Command\Handlers\UpdateCarHandler;
use Api\UI\Car\Http\Requests\PutCarRequest;
use Api\Domain\Car\Exception\CarNotFoundException;
use Illuminate\Http\JsonResponse;

class UpdateCarController extends Controller
{
    public function __construct(
        private UpdateCarHandler $handler
    ) {

    }

    /**
     * @param PutCarRequest $request
     * @return JsonResponse
     * @throws CarNotFoundException
     */
    public function __invoke(PutCarRequest $request): JsonResponse
    {
        $command = new UpdateCarCommand($request);
        return response()->json($this->handler->handle($command));
    }
}

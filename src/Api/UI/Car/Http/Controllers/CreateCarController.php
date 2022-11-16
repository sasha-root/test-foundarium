<?php declare(strict_types=1);

namespace Api\UI\Car\Http\Controllers;

use Api\UI\Common\Http\Controllers\Controller;
use Api\Application\Car\Command\Commands\CreateCarCommand;
use Api\Application\Car\Command\Handlers\CreateCarHandler;
use Api\UI\Car\Http\Requests\PostCarRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CreateCarController extends Controller
{
    public function __construct(
        private readonly CreateCarHandler $handler
    ) {

    }

    /**
     * @param PostCarRequest $request
     * @return JsonResponse
     */
    public function __invoke(PostCarRequest $request): JsonResponse
    {
        $command = new CreateCarCommand($request);
        return response()->json($this->handler->handle($command), ResponseAlias::HTTP_CREATED);
    }
}

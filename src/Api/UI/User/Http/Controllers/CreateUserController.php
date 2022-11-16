<?php declare(strict_types=1);

namespace Api\UI\User\Http\Controllers;

use Api\UI\Common\Http\Controllers\Controller;
use Api\UI\User\Http\Requests\PostUserRequest;
use Api\Application\User\Command\Commands\CreateUserCommand;
use Api\Application\User\Command\Handlers\CreateUserHandler;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CreateUserController extends Controller
{
    public function __construct(
        private readonly CreateUserHandler $handler
    ) {

    }

    /**
     * @param PostUserRequest $request
     * @return JsonResponse
     */
    public function __invoke(PostUserRequest $request): JsonResponse
    {
        $command = new CreateUserCommand($request);
        return response()->json($this->handler->handle($command), ResponseAlias::HTTP_CREATED);
    }
}

<?php declare(strict_types=1);

namespace Api\UI\User\Http\Controllers;

use Api\UI\Common\Http\Controllers\Controller;
use Api\UI\User\Http\Requests\PutUserRequest;
use Api\Application\User\Command\Commands\UpdateUserCommand;
use Api\Application\User\Command\Handlers\UpdateUserHandler;
use Illuminate\Http\JsonResponse;
use Api\Domain\User\Exception\UserNotFoundException;

class UpdateUserController extends Controller
{
    public function __construct(
        private readonly UpdateUserHandler $handler
    ) {

    }

    /**
     * @param PutUserRequest $request
     * @return JsonResponse
     * @throws UserNotFoundException
     */
    public function __invoke(PutUserRequest $request): JsonResponse
    {
        $command = new UpdateUserCommand($request);
        return response()->json($this->handler->handle($command));
    }
}

<?php declare(strict_types=1);

namespace Api\UI\User\Http\Controllers;

use Api\Application\User\Command\Commands\DeleteUserCommand;
use Api\Application\User\Command\Handlers\DeleteUserHandler;
use Api\UI\Common\Http\Controllers\Controller;
use Api\UI\User\Http\Requests\DeleteUserRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Api\Domain\User\Exception\UserNotFoundException;
use Api\Domain\User\Exception\UserNotAvailableDeleteException;

class DeleteUserController extends Controller
{
    public function __construct(
        private DeleteUserHandler $handler
    ) {

    }

    /**
     * @param DeleteUserRequest $request
     * @return JsonResponse
     * @throws UserNotFoundException|UserNotAvailableDeleteException
     */
    public function __invoke(DeleteUserRequest $request): JsonResponse
    {
        $command = new DeleteUserCommand($request->getUserId());
        $this->handler->handle($command);
        return response()->json(null, ResponseAlias::HTTP_NO_CONTENT);
    }
}

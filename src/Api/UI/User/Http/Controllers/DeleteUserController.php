<?php declare(strict_types=1);

namespace Api\UI\User\Http\Controllers;

use Api\Application\User\Command\Commands\DeleteUserCommand;
use Api\Application\User\Command\Handlers\DeleteUserHandler;
use Api\UI\Common\Http\Controllers\Controller;
use Api\UI\User\Http\Requests\DeleteUserRequest;

class DeleteUserController extends Controller
{
    public function __construct(
        private DeleteUserHandler $handler
    ) {

    }

    public function __invoke(DeleteUserRequest $request)
    {
        $command = new DeleteUserCommand($request->getUserId());
        return $this->handler->handle($command);
    }
}

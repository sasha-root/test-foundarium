<?php declare(strict_types=1);

namespace Api\UI\User\Http\Controllers;

use Api\UI\Common\Http\Controllers\Controller;
use Api\UI\User\Http\Requests\PutUserRequest;
use Api\Application\User\Command\Commands\UpdateUserCommand;
use Api\Application\User\Command\Handlers\UpdateUserHandler;

class UpdateUserController extends Controller
{
    public function __construct(
        private UpdateUserHandler $handler
    ) {

    }

    public function __invoke(PutUserRequest $request)
    {
        $command = new UpdateUserCommand($request, $request->getUserId());
        return $this->handler->handle($command);
    }
}

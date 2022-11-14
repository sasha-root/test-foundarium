<?php declare(strict_types=1);

namespace Api\UI\User\Http\Controllers;

use Api\UI\Common\Http\Controllers\Controller;
use Api\UI\User\Http\Requests\PostUserRequest;
use Api\Application\User\Command\Commands\CreateUserCommand;
use Api\Application\User\Command\Handlers\CreateUserHandler;

class CreateUserController extends Controller
{
    public function __construct(
        private CreateUserHandler $handler
    ) {

    }

    /**
     * @param PostUserRequest $request
     * @return
     */
    public function __invoke(PostUserRequest $request)
    {
        $command = new CreateUserCommand($request);
        return $this->handler->handle($command);
    }
}

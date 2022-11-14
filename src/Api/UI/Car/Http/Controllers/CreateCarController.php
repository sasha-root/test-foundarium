<?php declare(strict_types=1);

namespace Api\UI\Car\Http\Controllers;

use Api\Application\Car\Command\Commands\CreateCarCommand;
use Api\Application\Car\Command\Handlers\CreateCarHandler;
use Api\UI\Car\Http\Requests\PostCarRequest;
use Api\UI\Common\Http\Controllers\Controller;

class CreateCarController extends Controller
{
    public function __construct(
        private CreateCarHandler $handler
    ) {

    }

    public function __invoke(PostCarRequest $request)
    {
        $command = new CreateCarCommand($request);
        return $this->handler->handle($command);
    }
}

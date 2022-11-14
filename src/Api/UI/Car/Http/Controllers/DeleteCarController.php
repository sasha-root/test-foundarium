<?php declare(strict_types=1);

namespace Api\UI\Car\Http\Controllers;

use Api\UI\Common\Http\Controllers\Controller;
use Api\UI\Car\Http\Requests\DeleteCarRequest;
use Api\Application\Car\Command\Commands\DeleteCarCommand;
use Api\Application\Car\Command\Handlers\DeleteCarHandler;

class DeleteCarController extends Controller
{
    public function __construct(
        private DeleteCarHandler $handler
    ) {

    }

    public function __invoke(DeleteCarRequest $request)
    {
        $command = new DeleteCarCommand($request->getCarId());
        return $this->handler->handle($command);
    }
}

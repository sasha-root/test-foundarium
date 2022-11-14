<?php declare(strict_types=1);

namespace Api\UI\Car\Http\Controllers;

use Api\Application\Car\Command\Commands\UpdateCarCommand;
use Api\Application\Car\Command\Handlers\UpdateCarHandler;
use Api\UI\Car\Http\Requests\PutCarRequest;
use Api\UI\Common\Http\Controllers\Controller;

class UpdateCarController extends Controller
{
    public function __construct(
        private UpdateCarHandler $handler
    ) {

    }

    public function __invoke(PutCarRequest $request)
    {
        $command = new UpdateCarCommand($request);
        return $this->handler->handle($command);
    }
}

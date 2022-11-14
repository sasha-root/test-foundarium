<?php declare(strict_types=1);

namespace Api\Application\Car\Command\Handlers;

use Api\Application\Car\Command\Commands\CreateCarCommand;

class CreateCarHandler
{
    public function handle(CreateCarCommand $command)
    {
        echo "<pre>"; print_r($command); die;
    }
}

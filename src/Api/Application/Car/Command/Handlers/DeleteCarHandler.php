<?php declare(strict_types=1);

namespace Api\Application\Car\Command\Handlers;

use Api\Application\Car\Command\Commands\DeleteCarCommand;

class DeleteCarHandler
{
    public function handle(DeleteCarCommand $command)
    {
        echo "<pre>"; print_r($command); die;
    }
}

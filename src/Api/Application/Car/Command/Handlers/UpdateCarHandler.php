<?php declare(strict_types=1);

namespace Api\Application\Car\Command\Handlers;

use Api\Application\Car\Command\Commands\UpdateCarCommand;

class UpdateCarHandler
{
    public function handle(UpdateCarCommand $command)
    {
        echo "<pre>"; print_r($command); die;
    }
}

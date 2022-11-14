<?php declare(strict_types=1);

namespace Api\Application\User\Command\Handlers;

use Api\Application\User\Command\Commands\UpdateUserCommand;

class UpdateUserHandler
{
    public function handle(UpdateUserCommand $command)
    {
        echo "<pre>"; print_r($command); die;
    }
}

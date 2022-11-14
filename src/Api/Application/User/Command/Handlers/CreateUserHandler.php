<?php declare(strict_types=1);

namespace Api\Application\User\Command\Handlers;

use Api\Application\User\Command\Commands\CreateUserCommand;

class CreateUserHandler
{
    public function handle(CreateUserCommand $command)
    {
        echo "<pre>"; print_r($command); die;
    }
}

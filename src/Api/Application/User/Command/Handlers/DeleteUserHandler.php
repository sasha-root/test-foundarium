<?php declare(strict_types=1);

namespace Api\Application\User\Command\Handlers;

use Api\Application\User\Command\Commands\DeleteUserCommand;

class DeleteUserHandler
{
    public function handle(DeleteUserCommand $command)
    {
        echo "<pre>"; print_r($command); die;
    }

}

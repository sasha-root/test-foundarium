<?php declare(strict_types=1);

namespace Api\Application\User\Command\Handlers;

use Api\Application\User\Command\Commands\DeleteUserCommand;
use Api\Domain\User\Exception\UserNotFoundException;
use Api\Infrastructure\User\Repository\UserRepository;

class DeleteUserHandler
{
    public function __construct(
        private UserRepository $repository
    ) {

    }

    /**
     * @throws UserNotFoundException
     */
    public function handle(DeleteUserCommand $command)
    {
        if (!$user = $this->repository->findOneById($command->getId())) {
            throw new UserNotFoundException();
        }
        $this->repository->delete($user);
    }
}

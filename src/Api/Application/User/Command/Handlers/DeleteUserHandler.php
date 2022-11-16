<?php declare(strict_types=1);

namespace Api\Application\User\Command\Handlers;

use Api\Domain\User\Exception\UserNotAvailableDeleteException;
use Api\Domain\User\Model\User;
use Api\Domain\User\Repository\UserRepository;
use Api\Application\User\Command\Commands\DeleteUserCommand;
use Api\Domain\User\Exception\UserNotFoundException;
use Api\Domain\User\Service\UserService;

class DeleteUserHandler
{
    public function __construct(
        private UserRepository $repository,
        private UserService $service
    ) {

    }

    /**
     * @throws UserNotFoundException|UserNotAvailableDeleteException
     */
    public function handle(DeleteUserCommand $command): void
    {
        /** @var User|null $user */
        if (!$user = $this->repository->findOneById($command->getId())) {
            throw new UserNotFoundException();
        }

        if (!$this->service->isAvailableDelete($user->id)) {
            throw new UserNotAvailableDeleteException();
        }

        $this->repository->delete($user);
    }
}

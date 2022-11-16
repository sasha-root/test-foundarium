<?php declare(strict_types=1);

namespace Api\Application\User\Command\Handlers;

use Api\Domain\User\Repository\UserRepository;
use Api\Application\User\Command\Commands\UpdateUserCommand;
use Api\Application\User\Query\Views\UserView;
use Api\Domain\User\Exception\UserNotFoundException;
use Api\Domain\User\Model\User;

class UpdateUserHandler
{
    public function __construct(
        private UserRepository $repository
    ) {

    }

    /**
     * @throws UserNotFoundException
     */
    public function handle(UpdateUserCommand $command): UserView
    {
        if (!$user = $this->repository->findOneById($command->getId())) {
            throw new UserNotFoundException();
        }

        /** @var User $user */
        $user->updateUser(
            $command->getName(),
            $command->getEmail()
        );

        $user = $this->repository->store($user);
        return new UserView($user);
    }
}

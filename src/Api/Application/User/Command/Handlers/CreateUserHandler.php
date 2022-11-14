<?php declare(strict_types=1);

namespace Api\Application\User\Command\Handlers;

use Api\Application\User\Command\Commands\CreateUserCommand;
use Api\Application\User\Query\Views\UserView;
use Api\Domain\User\Model\User;
use Api\Infrastructure\User\Repository\UserRepository;

class CreateUserHandler
{
    public function __construct(
        private UserRepository $repository
    ) {

    }

    public function handle(CreateUserCommand $command): UserView
    {
        $user = User::createUser(
            $command->getName(),
            $command->getEmail(),
            $command->getPassword()
        );

        $user = $this->repository->store($user);
        return new UserView($user);
    }
}

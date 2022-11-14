<?php declare(strict_types=1);

namespace Api\Application\User\Query\Handlers;

use Api\Application\User\Query\Queries\FetchUserQuery;
use Api\Application\User\Query\Views\UserView;
use Api\Domain\User\Exception\UserNotFoundException;
use Api\Infrastructure\User\Repository\UserRepository;

class FetchUserHandler
{
    public function __construct(
        private UserRepository $repository
    ) {

    }

    /**
     * @throws UserNotFoundException
     */
    public function handle(FetchUserQuery $query): UserView
    {
        if (!$user = $this->repository->findOneById($query->getId())) {
            throw new UserNotFoundException();
        }
        return new UserView($user);
    }
}

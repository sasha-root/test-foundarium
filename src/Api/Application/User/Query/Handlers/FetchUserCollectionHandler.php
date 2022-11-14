<?php declare(strict_types=1);

namespace Api\Application\User\Query\Handlers;

use Api\Application\User\Query\Collection\UserCollection;
use Api\Application\User\Query\Queries\FetchUserCollectionQuery;
use Api\Infrastructure\User\Repository\UserRepository;

class FetchUserCollectionHandler
{
    public function __construct(
        private UserRepository $repository
    ) {

    }

    public function handle(FetchUserCollectionQuery $query): UserCollection
    {
        $users = $this->repository->findByFilters($query->getPagination(), $query->getOrderBy());
        return new UserCollection($users);
    }
}

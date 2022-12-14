<?php declare(strict_types=1);

namespace Api\Application\Car\Query\Handlers;

use Api\Application\Car\Query\Collection\CarCollection;
use Api\Application\Car\Query\Queries\FetchCarCollectionQuery;
use Api\Domain\Car\Repository\CarRepository;

class FetchCarCollectionHandler
{
    public function __construct(
        private readonly CarRepository $repository
    ) {

    }

    public function handle(FetchCarCollectionQuery $query): CarCollection
    {
        $cars = $this->repository->findByFilters($query->getPagination(), $query->getOrderBy());
        return new CarCollection($cars);
    }
}

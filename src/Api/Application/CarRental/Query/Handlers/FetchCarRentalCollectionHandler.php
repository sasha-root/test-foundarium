<?php declare(strict_types=1);

namespace Api\Application\CarRental\Query\Handlers;

use Api\Application\CarRental\Query\Queries\FetchCarRentalCollectionQuery;
use Api\Infrastructure\CarRental\Repository\EloquentCarRentalRepository;
use Api\Application\CarRental\Query\Collection\CarRentalCollection;

class FetchCarRentalCollectionHandler
{
    public function __construct(
        private EloquentCarRentalRepository $repository
    ) {

    }

    public function handle(FetchCarRentalCollectionQuery $query): CarRentalCollection
    {
        $carsRental = $this->repository->findByFilters($query->getPagination(), $query->getOrderBy());
        return new CarRentalCollection($carsRental);
    }
}

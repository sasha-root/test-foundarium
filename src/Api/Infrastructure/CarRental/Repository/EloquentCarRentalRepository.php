<?php declare(strict_types=1);

namespace Api\Infrastructure\CarRental\Repository;

use Api\Domain\CarRental\Repository\CarRentalRepository as CarRentalRepositoryInterface;
use Api\Infrastructure\Common\Repository\EloquentRepository;
use Api\Domain\CarRental\Model\CarRental as Model;

class EloquentCarRentalRepository extends EloquentRepository implements CarRentalRepositoryInterface
{
    protected function getModelClass(): string
    {
        return Model::class;
    }
}

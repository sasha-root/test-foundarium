<?php declare(strict_types=1);

namespace Api\Infrastructure\Car\Repository;

use Api\Infrastructure\Common\Repository\EloquentRepository;
use Api\Domain\Car\Model\Car as Model;
use Api\Domain\Car\Repository\CarRepository as CarRepositoryInterface;

class CarRepository extends EloquentRepository implements CarRepositoryInterface
{
    protected function getModelClass(): string
    {
        return Model::class;
    }
}

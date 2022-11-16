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

    public function existsByCarId(int $carId): bool
    {
        return $this->model->where(['car_id' => $carId])->exists();
    }

    public function existsByUserId(int $userId): bool
    {
        return $this->model->where(['user_id' => $userId])->exists();
    }
}

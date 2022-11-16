<?php declare(strict_types=1);

namespace Api\Infrastructure\Car\Service;

use Api\Domain\Car\Service\CarService;
use Api\Domain\CarRental\Repository\CarRentalRepository;

class EloquentCarService implements CarService
{
    public function __construct(
        private readonly CarRentalRepository $carRentalRepository
    ) {

    }

    public function isAvailableDelete(int $carId): bool
    {
        return !$this->carRentalRepository->existsByCarId($carId);
    }
}

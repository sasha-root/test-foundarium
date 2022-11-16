<?php declare(strict_types=1);

namespace Api\Domain\CarRental\Repository;

interface CarRentalRepository
{
    public function existsByCarId(int $carId): bool;

    public function existsByUserId(int $userId): bool;
}


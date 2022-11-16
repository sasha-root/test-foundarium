<?php declare(strict_types=1);

namespace Api\Domain\Car\Service;

interface CarService
{
    public function isAvailableDelete(int $carId): bool;
}

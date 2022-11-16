<?php declare(strict_types=1);

namespace Api\Infrastructure\User\Service;

use Api\Domain\CarRental\Repository\CarRentalRepository;
use Api\Domain\User\Service\UserService;

class EloquentUserService implements UserService
{
    public function __construct(
        private CarRentalRepository $carRentalRepository
    ) {

    }

    public function isAvailableDelete(int $userId): bool
    {
        return !$this->carRentalRepository->existsByUserId($userId);
    }
}

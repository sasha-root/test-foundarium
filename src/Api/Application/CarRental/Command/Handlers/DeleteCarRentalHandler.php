<?php declare(strict_types=1);

namespace Api\Application\CarRental\Command\Handlers;

use Api\Application\CarRental\Command\Commands\DeleteCarRentalCommand;
use Api\Domain\CarRental\Exception\CarRentalNotFoundException;
use Api\Infrastructure\CarRental\Repository\EloquentCarRentalRepository;

class DeleteCarRentalHandler
{
    public function __construct(
        private readonly EloquentCarRentalRepository $repository
    ) {

    }

    /**
     * @throws CarRentalNotFoundException
     */
    public function handle(DeleteCarRentalCommand $command): void
    {
        if (!$carRental = $this->repository->findOneById($command->getId())) {
            throw new CarRentalNotFoundException();
        }
        $this->repository->delete($carRental);
    }
}

<?php declare(strict_types=1);

namespace Api\Application\CarRental\Command\Handlers;

use Api\Application\CarRental\Command\Commands\DeleteCarRentalCommand;
use Api\Domain\CarRental\Exception\CarRentalNotFoundException;
use Api\Infrastructure\CarRental\Repository\CarRentalRepository;

class DeleteCarRentalHandler
{
    public function __construct(
        private CarRentalRepository $repository
    ) {

    }

    /**
     * @throws CarRentalNotFoundException
     */
    public function handle(DeleteCarRentalCommand $command)
    {
        if (!$carRental = $this->repository->findOneById($command->getId())) {
            throw new CarRentalNotFoundException();
        }
        $this->repository->delete($carRental);
    }
}

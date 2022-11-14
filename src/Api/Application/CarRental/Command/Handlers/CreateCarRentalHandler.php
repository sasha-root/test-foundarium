<?php declare(strict_types=1);

namespace Api\Application\CarRental\Command\Handlers;

use Api\Application\CarRental\Command\Commands\CreateCarRentalCommand;
use Api\Application\CarRental\Query\Views\CarRentalView;
use Api\Domain\CarRental\Model\CarRental;
use Api\Infrastructure\CarRental\Repository\CarRentalRepository;

class CreateCarRentalHandler
{
    public function __construct(
        private CarRentalRepository $repository
    ) {

    }

    public function handle(CreateCarRentalCommand $command): CarRentalView
    {
        $carRental = CarRental::createCarRental(
            $command->getUserId(),
            $command->getCarId()
        );

        $carRental = $this->repository->store($carRental);
        return new CarRentalView($carRental);
    }
}

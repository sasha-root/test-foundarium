<?php declare(strict_types=1);

namespace Api\Application\Car\Command\Handlers;

use Api\Domain\Car\Repository\CarRepository;
use Api\Application\Car\Command\Commands\CreateCarCommand;
use Api\Application\Car\Query\Views\CarView;
use Api\Domain\Car\Model\Car;

class CreateCarHandler
{
    public function __construct(
        private readonly CarRepository $repository
    ) {

    }

    public function handle(CreateCarCommand $command): CarView
    {
        $car = Car::createCar(
            $command->getModel(),
            $command->getName(),
            $command->getRegistrationPlate()
        );

        $car = $this->repository->store($car);
        return new CarView($car);
    }
}

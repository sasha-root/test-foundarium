<?php declare(strict_types=1);

namespace Api\Application\Car\Command\Handlers;

use Api\Application\Car\Command\Commands\CreateCarCommand;
use Api\Application\Car\Query\Views\CarView;
use Api\Domain\Car\Model\Car;
use Api\Infrastructure\Car\Repository\CarRepository;

class CreateCarHandler
{
    public function __construct(
        private CarRepository $repository
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

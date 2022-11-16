<?php declare(strict_types=1);

namespace Api\Application\Car\Command\Handlers;

use Api\Domain\Car\Repository\CarRepository;
use Api\Application\Car\Command\Commands\UpdateCarCommand;
use Api\Application\Car\Query\Views\CarView;
use Api\Domain\Car\Exception\CarNotFoundException;
use Api\Domain\Car\Model\Car;
use Api\Infrastructure\Car\Repository\EloquentCarRepository;

class UpdateCarHandler
{
    public function __construct(
        private EloquentCarRepository $repository
    ) {

    }

    /**
     * @throws CarNotFoundException
     */
    public function handle(UpdateCarCommand $command): CarView
    {
        if (!$car = $this->repository->findOneById($command->getId())) {
            throw new CarNotFoundException();
        }

        /** @var Car $car */
        $car->updateCar(
            $command->getModel(),
            $command->getName(),
            $command->getRegistrationPlate()
        );

        $car = $this->repository->store($car);
        return new CarView($car);
    }
}

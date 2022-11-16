<?php declare(strict_types=1);

namespace Api\Application\Car\Command\Handlers;

use Api\Domain\Car\Exception\CarNotAvailableDeleteException;
use Api\Domain\Car\Model\Car;
use Api\Domain\Car\Repository\CarRepository;
use Api\Domain\Car\Service\CarService;
use Api\Application\Car\Command\Commands\DeleteCarCommand;
use Api\Domain\Car\Exception\CarNotFoundException;

class DeleteCarHandler
{
    public function __construct(
        private readonly CarRepository $repository,
        private readonly CarService    $service
    ) {

    }

    /**
     * @throws CarNotFoundException|CarNotAvailableDeleteException
     */
    public function handle(DeleteCarCommand $command): void
    {
        /** @var Car|null $car */
        if (!$car = $this->repository->findOneById($command->getId())) {
            throw new CarNotFoundException();
        }

        if (!$this->service->isAvailableDelete($car->id)) {
            throw new CarNotAvailableDeleteException();
        }

        $this->repository->delete($car);
    }
}

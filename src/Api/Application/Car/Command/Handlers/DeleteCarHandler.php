<?php declare(strict_types=1);

namespace Api\Application\Car\Command\Handlers;

use Api\Application\Car\Command\Commands\DeleteCarCommand;
use Api\Domain\Car\Exception\CarNotFoundException;
use Api\Infrastructure\Car\Repository\CarRepository;

class DeleteCarHandler
{
    public function __construct(
        private CarRepository $repository
    ) {

    }

    /**
     * @throws CarNotFoundException
     */
    public function handle(DeleteCarCommand $command)
    {
        if (!$car = $this->repository->findOneById($command->getId())) {
            throw new CarNotFoundException();
        }
        $this->repository->delete($car);
    }
}

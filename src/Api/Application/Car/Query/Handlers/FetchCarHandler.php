<?php declare(strict_types=1);

namespace Api\Application\Car\Query\Handlers;

use Api\Application\Car\Query\Queries\FetchCarQuery;
use Api\Application\Car\Query\Views\CarView;
use Api\Domain\Car\Exception\CarNotFoundException;
use Api\Domain\Car\Repository\CarRepository;

class FetchCarHandler
{
    public function __construct(
        private readonly CarRepository $repository
    ) {

    }

    /**
     * @throws CarNotFoundException
     */
    public function handle(FetchCarQuery $query): CarView
    {
        if (!$car = $this->repository->findOneById($query->getId())) {
            throw new CarNotFoundException();
        }
        return new CarView($car);
    }
}

<?php declare(strict_types=1);

namespace Api\Application\CarRental\Command\Commands;

use Api\UI\CarRental\Http\Requests\PostCarRentalRequest;

class CreateCarRentalCommand
{
    private int $carId;

    private int $userId;

    public function __construct(PostCarRentalRequest $request)
    {
        $this->userId = $request->getUserId();
        $this->carId = $request->getCarId();
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getCarId(): int
    {
        return $this->carId;
    }
}

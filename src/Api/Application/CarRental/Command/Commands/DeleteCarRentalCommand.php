<?php declare(strict_types=1);

namespace Api\Application\CarRental\Command\Commands;

class DeleteCarRentalCommand
{
    public function __construct(
        private int $id
    ) {

    }

    public function getId(): int
    {
        return $this->id;
    }
}

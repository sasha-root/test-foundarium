<?php declare(strict_types=1);

namespace Api\Application\Car\Command\Commands;

class DeleteCarCommand
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

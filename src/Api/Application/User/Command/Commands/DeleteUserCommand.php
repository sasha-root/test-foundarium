<?php declare(strict_types=1);

namespace Api\Application\User\Command\Commands;

class DeleteUserCommand
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

<?php declare(strict_types=1);

namespace Api\Application\Car\Query\Queries;

class FetchCarQuery extends \Api\Infrastructure\Car\Repository\EloquentCarRepository
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


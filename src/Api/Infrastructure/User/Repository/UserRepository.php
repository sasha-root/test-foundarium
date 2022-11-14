<?php declare(strict_types=1);

namespace Api\Infrastructure\User\Repository;

use Api\Infrastructure\Common\Repository\EloquentRepository;
use Api\Domain\User\Model\User as Model;
use Api\Domain\User\Repository\UserRepository as UserRepositoryInterface;

class UserRepository extends EloquentRepository implements UserRepositoryInterface
{
    protected function getModelClass(): string
    {
        return Model::class;
    }
}

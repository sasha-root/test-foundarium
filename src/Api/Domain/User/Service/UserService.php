<?php declare(strict_types=1);

namespace Api\Domain\User\Service;

interface UserService
{
    public function isAvailableDelete(): bool;
}

<?php declare(strict_types=1);

namespace Api\Domain\User\Exception;

use Api\Domain\Common\Exception\DomainException;

class UserNotFoundException extends DomainException
{
    protected $message = "User not found.";

    protected $code = 404;
}

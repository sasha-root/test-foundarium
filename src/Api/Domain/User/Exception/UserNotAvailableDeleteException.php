<?php declare(strict_types=1);

namespace Api\Domain\User\Exception;

use Api\Domain\Common\Exception\DomainException;

class UserNotAvailableDeleteException extends DomainException
{
    protected $message = 'The user drives the car, cannot be removed.';

    protected $code = 400;
}

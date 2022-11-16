<?php declare(strict_types=1);

namespace Api\Domain\Car\Exception;

use Api\Domain\Common\Exception\DomainException;

class CarNotAvailableDeleteException extends DomainException
{
    protected $message = 'Car in use, cannot be removed.';

    protected $code = 400;
}

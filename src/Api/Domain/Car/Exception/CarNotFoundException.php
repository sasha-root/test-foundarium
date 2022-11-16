<?php declare(strict_types=1);

namespace Api\Domain\Car\Exception;

use Api\Domain\Common\Exception\DomainException;

class CarNotFoundException extends DomainException
{
    protected $message = 'Car not found.';

    protected $code = 404;
}

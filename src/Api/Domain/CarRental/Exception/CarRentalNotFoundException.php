<?php declare(strict_types=1);

namespace Api\Domain\CarRental\Exception;

use Api\Domain\Common\Exception\DomainException;

class CarRentalNotFoundException extends DomainException
{
    protected $message = "CarRental not found.";

    protected $code = 404;
}

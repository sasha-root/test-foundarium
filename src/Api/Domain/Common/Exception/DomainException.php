<?php declare(strict_types=1);

namespace Api\Domain\Common\Exception;

abstract class DomainException extends \Exception
{
    protected $message;

    protected $code;

    public function __construct(string $message = '', int $code = 0, \Throwable $previous = null)
    {
        $args = func_get_args();
        parent::__construct($args[0] ?? $this->message, $this->code, $previous);
    }
}

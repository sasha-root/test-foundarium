<?php declare(strict_types=1);

namespace Api\Application\Car\Command\Commands;

use Api\UI\Car\Http\Requests\PutCarRequest;

class UpdateCarCommand extends CreateUpdateCarCommand
{
    private int $id;

    public function __construct(PutCarRequest $request)
    {
        $this->id = $request->getCarId();
        parent::__construct($request);
    }

    public function getId(): int
    {
        return $this->id;
    }
}

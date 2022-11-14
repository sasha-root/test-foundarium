<?php declare(strict_types=1);

namespace Api\Application\Car\Command\Commands;

use Api\UI\Car\Http\Requests\PostCarRequest;
use Api\UI\Car\Http\Requests\PutCarRequest;

class CreateUpdateCarCommand
{
    private string $model;

    private string $name;

    private string $registration_plate;

    public function __construct(PostCarRequest|PutCarRequest $request)
    {
        $this->model = $request->getModel();
        $this->name = $request->getName();
        $this->registration_plate = $request->getRegistrationPlate();
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRegistrationPlate(): string
    {
        return $this->registration_plate;
    }
}

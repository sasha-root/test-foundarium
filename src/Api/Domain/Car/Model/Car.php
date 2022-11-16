<?php declare(strict_types=1);

namespace Api\Domain\Car\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Api\Domain\Common\Model\EloquentBaseModal;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model Car
 *
 * @property int $id
 * @property string $model
 * @property string $name
 * @property string $registration_plate
 */
class Car extends EloquentBaseModal
{
    use HasFactory, SoftDeletes;

    public static function createCar(string $model, string $name, string $registrationPlate): self
    {
        $car = new self();
        $car->setModel($model);
        $car->setName($name);
        $car->setRegistrationPlate($registrationPlate);

        return $car;
    }

    public function updateCar(string $model, string $name, string $registrationPlate): self
    {
        $this->setModel($model);
        $this->setName($name);
        $this->setRegistrationPlate($registrationPlate);

        return $this;
    }

    public function setModel(string $model)
    {
        $this->model = $model;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setRegistrationPlate(string $registrationPlate)
    {
        $this->registration_plate = $registrationPlate;
    }
}

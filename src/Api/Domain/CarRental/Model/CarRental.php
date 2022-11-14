<?php declare(strict_types=1);

namespace Api\Domain\CarRental\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Api\Domain\Car\Model\Car;
use Api\Domain\User\Model\User;

/**
 * CarRental modal
 *
 * @property int $id
 * @property int $car_id
 * @property int $user_id
 * @property-read Car $car
 * @property-read User $user
 */
class CarRental extends Model
{
    use HasFactory;

    protected $table = 'cars_rental';

    public static function createCarRental(int $userId, int $carId): self
    {
        $model = new self();
        $model->setUserId($userId);
        $model->setCarId($carId);

        return $model;
    }

    public function setUserId(int $userId)
    {
        $this->user_id = $userId;
    }

    public function setCarId(int $carId)
    {
        $this->car_id = $carId;
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

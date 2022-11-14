<?php declare(strict_types=1);

namespace Api\Application\CarRental\Query\Views;

use Api\Application\Car\Query\Views\CarView;
use Api\Application\User\Query\Views\UserView;
use Api\Domain\CarRental\Model\CarRental;
use Illuminate\Http\Resources\Json\JsonResource;

class CarRentalView extends JsonResource
{
    public function toArray($request)
    {
        /** @var CarRental|self $this */
        return [
            'id' => $this->id,
            'car' => (new CarView($this->car))->resolve(),
            'user' => (new UserView($this->user))->resolve()
        ];
    }
}

<?php declare(strict_types=1);

namespace Api\Application\Car\Query\Views;

use Illuminate\Http\Resources\Json\JsonResource;
use Api\Domain\Car\Model\Car;

class CarView extends JsonResource
{
    public function toArray($request): array
    {
        /** @var Car|self $this */
        return [
            'id' => $this->id,
            'model' => $this->model,
            'name' => $this->name,
            'registration_plate' => $this->registration_plate
        ];
    }
}

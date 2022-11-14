<?php declare(strict_types=1);

namespace Api\Application\User\Query\Views;

use Api\Domain\User\Model\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserView extends JsonResource
{
    public function toArray($request): array
    {
        /** @var User|self $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email
        ];
    }
}
